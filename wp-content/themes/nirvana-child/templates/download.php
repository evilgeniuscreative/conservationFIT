<?php /*
Template Name: Download Images
*/
preg_match(',/observation-download/(\d+)/,', $_SERVER['REQUEST_URI'], $matches);
$data_point_id = $matches[1];
$data = inat_get_call('observations', $data_point_id);
$species = 'unk';
if (strlen($data->species_guess) > 0) {
    $species = preg_replace('/\W+|\s\s+/', '_',$data->species_guess);
}
$zipFiles = array();
$zip = new ZipArchive();
$tmp_file = tempnam('.', '');
$zip->open($tmp_file, ZipArchive::CREATE);
foreach ($data->observation_photos as $onePhoto) {
    #download the image
    $download_file = file_get_contents($onePhoto->photo->large_url);
    # rename it
    $photoName = $species . "_" . $onePhoto->observation_id . "_" . $onePhoto->id . ".jpg";
    #add it to the zip
    $zip->addFromString(basename($photoName), $download_file);
}
# close zip
$zip->close();

$zipExt = '_photos.zip';
# send the file to the browser as a download
header('Content-disposition: attachment; filename='.$species.'_'.$data->id.$zipExt);
header('Content-type: application/zip');
readfile($tmp_file);
unlink($tmp_file);