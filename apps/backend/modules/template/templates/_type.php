<?php
echo select_tag('template[type]', options_for_select(array(
  '0' => 'dynamic',
  '1' => 'static (generic)',
), $template->getType()));
?>