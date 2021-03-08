<?php

namespace Drupal\views_year_filter\Plugin\views\filter;

use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\filter\InOperator;
use Drupal\views\ViewExecutable;

/**
 * Filters by given list of node title options.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("views_year_filter")
 */
class ViewsYearFilter extends InOperator
{

    static $content_type = 'actualite';

    /**
     * {@inheritdoc}
     */
    public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL)
    {
        parent::init($view, $display, $options);
        $this->valueTitle = t('Views year filter');
        $this->definition['options callback'] = array($this, 'generateOptions');
    }

    /**
     * Override the query so that no filtering takes place if the user doesn't
     * select any options.
     */
    public function query()
    {

        if (!empty($this->value)) {

            $this->ensureMyTable();

            $data = "";
            foreach ($this->value as $k => $v) {
                if ($k == count($this->value) - 1) {
                    $data .= "$v";
                } else {
                    $data .= "$v,";
                }
            }
            $this->query->addWhereExpression($this->options['group'], "Year($this->tableAlias.$this->realField) $this->operator  ($data)");
        }
    }

    /**
     * Skip validation if no options have been chosen so we can use it as a
     * non-filter.
     */
    public function validate()
    {
        if (!empty($this->value)) {
            parent::validate();
        }
    }


    /**
     * Helper function that generates the options.
     * @return array
     */
    public function generateOptions()
    {
        // Array keys are used to compare with the table field values.
        $query = \Drupal::entityQuery('node')
            ->condition('status', 1)
            ->condition('type', self::$content_type)
            ->sort('field_date', 'DESC');
        $nodes_ids = $query->execute();

        $years = [];
        if ($nodes_ids) {
            foreach ($nodes_ids as $node_id) {
                $node = \Drupal\node\Entity\Node::load($node_id);
                $parts = explode("-", $node->field_date->value);
                $years[$parts[0]] = $parts[0];
            }

        }

        return $years;
    }


}