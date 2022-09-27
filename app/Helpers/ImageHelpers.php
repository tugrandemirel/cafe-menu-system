<?php
class ImageHelpers
{
    public static function uploadImage($image, $path)
    {
        if (!file_exists($path))
            mkdir($path, 0777, true);

        $imageName = $path.time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imageName);
        return $imageName;
    }

    public static function deleteImage($image = null)
    {
        if ($image != null)
        {
            if (file_exists(public_path( $image))) {
                unlink(public_path($image));
            }
        }
    }

    public static function updateImage($image, $path, $oldImage)
    {
        self::deleteImage($oldImage);
        return self::uploadImage($image, $path);
    }
}
