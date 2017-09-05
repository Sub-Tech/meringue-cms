<?php

namespace Plugins\Meringue\PhotoGallery;

/**
 * Trait GalleryTypes
 */
trait GalleryTypes
{

    /**
     * Return an Array of Gallery Types so that Polymorphism can do
     *
     * @return array
     */
    private function getGalleryTypes()
    {
        $classPath = "Plugins\Meringue\PhotoGallery\Galleries\\";

        $types = [];

        foreach (trim_directory_path(scandir(__DIR__ . '/galleries')) as $gallery) {
            $className = rtrim($gallery, ".php");

            // Ignore the Interface
            if (str_contains($className, 'Interface')) {
                continue;
            }

            $types[$classPath . $className] = $className;
        }

        return $types;
    }

}