<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div class="skill-group">
<?php if (!empty($title)): ?>
<span class="field-label"><?php print $title; ?>:</span>
<?php endif; ?>
<?php foreach ($rows as $id => $row): ?>
<span<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
<?php print $row; ?>
</span>
<?php endforeach; ?>
</div>
