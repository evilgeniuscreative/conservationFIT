<div class = "inat-observation" id = "observation_<?php echo $viewData->id; ?>">
    <div class = "photo">
        <figure>
            <div class = "img" style = "background-image:url(<?php echo $viewData->photos[0]->medium_url ?>)" title = "<?php echo ucfirst($viewData->description) . " | photo " . $viewData->photos[0]->id . " [1 of " . sizeof($viewData->photos) . "]" ?>"></div>
            <figurecaption><?php echo $viewData->photos[0]->attribution ?></figurecaption>
        </figure>
    </div>
    <div class = "obs-details">
        <h4>
            <a href = "<?php home_url() ?>?page_id=706&amp;verb=observations&amp;id=<?php echo $viewData->id ?>"><?php echo $viewData->species_guess ?>
                <span class = "taxon-name"><?php echo " (" . $viewData->taxon->name . ")" ?></span>
            </a>
        </h4>
        <h5 class = "description"><?php echo ucfirst($viewData->description) ?></h5>
        <p class = "observer half">
            <span class = "label">Observer: </span><?php echo isset($viewData->user_login) ? $viewData->user_login : "unknown" ?>
        </p>
        <p class = "place half">
            <span class = "label">Place: </span><?php echo isset($viewData->place_guess) ? $viewData->place_guess : "unknown" ?>
        </p>
        <p class = "date half">
            <span class = "label">Date Observed: </span><?php echo isset($viewData->observed_on) ? date("M j, Y", strtotime($viewData->observed_on)) : "unknown" ?>
        </p>
        <p class = "obs-tags half">
            <span class = "label">Tags: </span><?php echo isset($viewData->tag_list) ? implode(", ", $viewData->tag_list) : "none" ?>
        </p>
        <p class = "photo-details half">
            <span class = "label">Photos: </span><?php echo sizeof($viewData->photos) ?></p>
        <p class = "link half">
            <a href = "<?php home_url() ?>?page_id=706&amp;verb=observations&amp;id=<?php echo $viewData->id ?>">Observation detail page</a>
        </p>
    </div>
</div>