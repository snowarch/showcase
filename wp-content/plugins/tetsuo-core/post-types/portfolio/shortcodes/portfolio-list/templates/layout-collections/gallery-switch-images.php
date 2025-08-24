<?php
$content_styles = $this_object->getStandardContentStyles($params);

echo tetsuo_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params); ?>