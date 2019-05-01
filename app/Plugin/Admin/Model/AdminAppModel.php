<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AdminAppModel extends Model {
    function createThumbnail($src, $dest, $targetWidth, $targetHeight = null) {
		$type = exif_imagetype($src);
		if (!$type || !IMAGE_HANDLERS[$type]) {
			return null;
		}
		$image = call_user_func(IMAGE_HANDLERS[$type]['load'], $src);
		if (!$image) {
			return null;
		}
		$width = imagesx($image);
		$height = imagesy($image);
		if ($targetHeight == null) {
			$ratio = $width / $height;
			if ($width > $height) {
				$targetHeight = floor($targetWidth / $ratio);
			}
			else {
				$targetHeight = $targetWidth;
				$targetWidth = floor($targetWidth * $ratio);
			}
		}
		$thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
		if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG) {
			imagecolortransparent(
				$thumbnail,
				imagecolorallocate($thumbnail, 0, 0, 0)
			);
			if ($type == IMAGETYPE_PNG) {
				imagealphablending($thumbnail, false);
				imagesavealpha($thumbnail, true);
			}
		}
		imagecopyresampled(
			$thumbnail,
			$image,
			0, 0, 0, 0,
			$targetWidth, $targetHeight,
			$width, $height
		);
		return call_user_func(
			IMAGE_HANDLERS[$type]['save'],
			$thumbnail,
			$dest,
			IMAGE_HANDLERS[$type]['quality']
		);
	}
}
