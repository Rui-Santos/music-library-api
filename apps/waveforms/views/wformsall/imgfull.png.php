<?php 
if($wformsall->imgSize == 0) {
	readfile("/PATH/GOES/HERE/api/img_cache/waveforms/waveform_full_".$wformsall->RecID.".png");
} else {
	readfile("/PATH/GOES/HERE/api/img_cache/waveforms/waveform_".$wformsall->imgSize."_".$wformsall->RecID.".png");
}
?>