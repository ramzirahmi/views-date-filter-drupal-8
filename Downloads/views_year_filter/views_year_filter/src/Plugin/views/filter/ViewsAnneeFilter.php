<?php

namespace Drupal\views_year_filter\Plugin\views\filter;

use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\filter\Equality;
use Drupal\views\ViewExecutable;

/**
 * Filters by given list of node title options.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("views_annee_filter")
 */
class ViewsAnneeFilter extends Equality
{


    /**
     * {@inheritdoc}
     */
    public function init(ViewExecutable $view, DisplayPluginBase $display, array &$options = NULL)
    {
        parent::init($view, $display, $options);
    }

    /**
     * Override the query so that no filtering takes place if the user doesn't
     * select any options.
     */
    public function query()
    {

        if (!empty($this->value)) {

            $this->ensureMyTable();

            $this->query->addWhereExpression($this->options['group'], "Year($this->tableAlias.$this->realField)  $this->operator " . $this->value);


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





}