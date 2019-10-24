<?php

namespace Form;

class Bundler {

    private $uri;
    private $files;
    private $output = '';

    public function __construct( $uri = false ) {
        $this->uri = $uri;

        // Register Route
        router()->get($uri, function() {
            header('Content-type: text/javascript');
            echo $this->compile();
            exit;
        });
    }

    /**
     * Add File
     *
     * @param string $id unique ID
     * @param string $file full path to file
     */
    public function addFile( $id, $file ) {

        // Get the file
        $contents = @file_get_contents($file);

        // Add to the files array
        $this->files[$id] = $contents;

    }

    /**
     * Compile
     */
    public function compile() {

        // Make sure we have some files
        if ( !is_array($this->files) ) {
            return false;
        }

        // Combine them all
        foreach ( $this->files as $file ) {
            $this->output .= $file;
        }

        return $this->output;

    }

}
