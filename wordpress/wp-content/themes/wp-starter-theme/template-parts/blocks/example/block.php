<?php

/**
 * Block: Example
 * - Slug: example
 */

// Local Variables
$blockID = (!empty($block['anchor']) ? $block['anchor'] : $block['id']);
$blockData = [
    'title' => get_field('title')
];

/***** ADMIN LABEL *****/
echo myTheme_blockAdminHead($block);
?>

<!-- BLOCK CONTENT -->
<section id="<?php echo $blockID; ?>" class="block block--example <?php echo isset($block["className"]) ? $block["className"] : '' ?>">
    <div class="container">

        <h2><?php echo $blockData['title']; ?></h2>
        <?php
        // Update the block's class on the <section> - ie: block--myBlock
        // Add your custom markup here!
        ?>

    </div>
</section>