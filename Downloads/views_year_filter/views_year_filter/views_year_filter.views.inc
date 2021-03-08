<?php

/**
 * Implements hook_views_data_alter().
 * @param array $data
 * @return array
 */
function views_year_filter_views_data_alter(array &$data)
{


    $data['node__field_date_rapport']['views_rapport_filter'] = array(
        'title' => t('Views rapport filter'),
        'filter' => array(
            'title' => t('Views rapport filter'),
            'help' => t('Create views rapport filter'),
            'field' => 'field_date_rapport_value',
            'id' => 'views_rapport_filter',
            'group' => 'Custom',
        ),
    );



    $data['node__field_date']['views_year_filter'] = array(
        'title' => t('Views year filter'),
        'filter' => array(

            'title' => t('Views year filter'),
            'help' => t('Create views year filter'),
            'field' => 'field_date_value',
            'id' => 'views_year_filter',
            'group' => 'Custom',
        ),
    );

    $data['node__field_date']['views_annee_filter'] = array(
        'title' => t('Views année filter'),
        'filter' => array(
            'title' => t('Views année filter'),
            'help' => t('Create views année filter'),
            'field' => 'field_date_value',
            'id' => 'views_annee_filter',
            'group' => 'Custom',
        ),
    );

    return $data;
}