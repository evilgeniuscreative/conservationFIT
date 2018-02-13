<div class = "inat-observation" id = "observation_<?php echo $viewData->id; ?>">
    <div class = "photo">
        <figure>
            <div class = "img"
                    style = "background-image:url(<?php echo $viewData->observation_photos[0]->photo->medium_url ?>)"
                    title = "<?php echo ucfirst($viewData->description) . " | photo " . $viewData->observation_photos[0]->id . " [1 of " . sizeof($viewData->observation_photos) . "]" ?>"></div>
            <figurecaption><?php echo convert_copyright($viewData->observation_photos[0]->photo->attribution) ?></figurecaption>
        </figure>
    </div>
    <div class = "obs-details">
        <h3>
            <?php echo $viewData->species_guess ?>
            <span class = "taxon-name"><?php echo " (" . $viewData->taxon->name . ")" ?></span>
        </h3>
        <h5 class = "description"><?php echo ucfirst($viewData->description) ?></h5>
        <p class = "observer half"><span
                    class = "label">Observer: </span><?php echo isset($viewData->user_login) ? $viewData->user_login : "unknown" ?>
        </p>
        <p class = "place half"><span
                    class = "label">Place: </span><?php echo isset($viewData->place_guess) ? $viewData->place_guess : "unknown" ?>
        </p>
        <p class = "date half"><span
                    class = "label">Date Observed: </span><?php echo isset($viewData->observed_on) ? date("M j, Y", strtotime($viewData->observed_on)) : "unknown" ?>
        </p>
        <p class = "obs-tags half"><span
                    class = "label">Tags: </span><?php echo isset($viewData->tag_list) ? implode(", ", $viewData->tag_list) : "none" ?>
        </p>
        <p class = "photo-details half"><span
                    class = "label">Photos: </span><?php echo sizeof($viewData->observation_photos) ?></p>

        <div class = "inat-photo-gallery">
            <?php

            foreach ($viewData->observation_photos as $onePhoto) {
                echo '<figure>
                            <a class="inat-photo-thumb">
                                <img src="' . $onePhoto->photo->square_url . '"/>
                            </a>
                            <div class="inat-photo-large">
                                   <i title="close"></i>
                                <img src="' . $onePhoto->photo->medium_url . '"/>                         
                            </div>
                        </figure>';
            }
            ?>
        </div>

        <?php
        if (sizeof($viewData->observation_photos) > 0) {
            ?>
            <div class = "obs-download-images">
                <a href = "/observation-download/<?php echo $viewData->id; ?>" target = "_blank">Download All Images</a>
            </div>
        <?php } ?>

        </p>
    </div>
</div>