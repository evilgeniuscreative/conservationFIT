<div class="bubble" id="bubble_<?php echo $viewData['id']; ?>">
    <h1><a href="<?php echo $viewData['permalink'] ?>"><?php echo $viewData['title'] ?></a></h1>

    <p class="description">
        <?php
        if ($viewData['thumbnail']) {
            echo $viewData['thumbnail'];
        }
        ?>
        <?php echo truncate_text(ucfirst($viewData['description']),99,$viewData['permalink']) ?>
    </p>

    <div class="partner-details">
        <?php echo isset($viewData['contact_name']) ? "<p><em>Contact:</em> " . $viewData['contact_name'] . "</p>" : "" ?>
        <p>
            <em>Location:</em> <?php echo isset($viewData['city']) ? $viewData['city'] : "" ?> <?php echo isset($viewData['state_or_province']) ? $viewData['state_or_province'] : "" ?> <?php echo isset($viewData['country']) ? $viewData['country'] : "" ?>
        </p>
        <p><em>Species:</em> <?php echo isset($viewData['species']) ? $viewData['species'] : "none" ?></p>
    </div>
</div>