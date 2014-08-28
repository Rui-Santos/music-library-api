<?php
Library::import('download.models.downloadmpsampler');
Library::import('download.models.downloadassets');
Library::import('recess.framework.forms.ModelForm');

/**
 * !RespondsWith Layouts
 * !Prefix downloadmpsampler/
 * !RoutesPrefix mpsampler/
 */
class downloadmpsamplerController extends Controller {
	
	/** @var downloadmpsampler */
	protected $downloadmpsampler;
	
	/** @var Form */
	protected $_form;
	
	function init() {
		$this->downloadmpsampler = new downloadmpsampler();
		$this->_form = new ModelForm('downloadmpsampler', $this->request->data('downloadmpsampler'), $this->downloadmpsampler);
	}
	
	/** 
	* !Route GET, $slug
	* */
	function downloadPlaylist($slug) {
	
	
		$time = time();

		$this->downloadmpsampler->slug=$slug;
		if($this->downloadmpsampler->exists()) {
					
			$assets = $this->downloadmpsampler->sampler_assets();
/*
			foreach ($assets as $asset):
				print_r($asset);
			endforeach;
*/
			$fileprefix = "MUSICPLAYGROUND";
			//print count($assets);
			
			$zip = new ZipArchive;
			$zipname = $fileprefix.'-'.$slug.'-'.rand().'.zip';
			if ($zip->open('/tmp/'.$zipname, ZipArchive::CREATE)===TRUE) {
				foreach ($assets as $asset):
					
					if(substr($asset->asset_key,0,8) == 'unsigned') {
						if(file_exists('/var/www/vhosts/thedinermusic.com/httpdocs/api/'.$asset->filepath)) {
							$zip->addFile('/var/www/vhosts/thedinermusic.com/httpdocs/api/'.$asset->filepath, $asset->filename);
						}
					} else {						
						$a = new downloadassets();
						$a->asset_key = $asset->asset_key;
						if($a->exists()) {
    						$assetPath = '/MEDIAPATH/GOES/HERE/media/'.$asset->cloudPrefixes()->MusicPlayground['path'].'/'.$a->Filename;
							if(file_exists($assetPath)) {
								$zip->addFile($assetPath, $a->Filename);
							}
						}
					}
									
				endforeach;
				
				if ($zip->close()) {
					// we deliver a zip file
					header("Cache-Control: ");# leave blank to avoid IE errors
					header("Pragma: ");# leave blank to avoid IE errors
					header("Content-Type: archive/zip");
				
					// filename for the browser to save the zip file
					header("Content-Disposition: attachment; filename=$zipname");
				
					chdir('/tmp/');
					$filesize = filesize($zipname);
					header("Content-Length: $filesize");
					$zipstatus = $this->readfile_chunked($zipname, true);
					if ($zipstatus) {
						unlink($zipname);
						$this->result = "ok";
					} else {
						$this->result = "another error";
					}
				} else {
					$this->result = "didn't close";
				}
			} else {
				$this->result = "couldn't open";
			}
	
		} else {
			print 'fail';
		}
		exit;
	}
}
?>