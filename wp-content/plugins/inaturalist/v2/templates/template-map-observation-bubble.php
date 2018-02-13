<div class="bubble" id="bubble_<?php echo $viewData->id; ?>">
    <h1>
        <a href="<?php echo home_url() .'/inat/observation-single/'. $viewData->id ?>"><?php echo $viewData->species_guess ?>
            <span class="taxon-name"><?php echo " (" . $viewData->taxon->name . ")" ?></span>
        </a>
    </h1>
    <p class="description"><?php echo truncate_text(ucfirst($viewData->description),99,home_url() .'/inat/observation-single/'. $viewData->id) ?></p>
    <div class="obs-info">
        <div class="obs-thumbnail"><img src="<?php echo $viewData->photos[0]->thumb_url ?>" scale="0"></div>
        <div class="obs-details"><p>
                <em>Date:</em> <?php echo isset($viewData->observed_on) ? date("M j, Y", strtotime($viewData->observed_on)) : "unknown" ?>
            </p>
            <p><em>Location:</em> <?php echo isset($viewData->place_guess) ? $viewData->place_guess : "unknown" ?></p>
            <p><em>Tags:</em> <?php echo isset($viewData->tag_list) ? implode(", ", $viewData->tag_list) : "none" ?></p>
            <p><em>Observer:</em> <?php echo isset($viewData->user_login) ? $viewData->user_login : "unknown" ?></p>
        </div>
    </div>
</div>