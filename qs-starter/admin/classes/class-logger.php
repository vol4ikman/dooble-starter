<?php
class QS_logger{

    public function __construct( $file_name , $new_file = false ){

        $upload_dir = wp_upload_dir();

        $this->filename  = $file_name;
        $this->file_path = $upload_dir['basedir'].'/logs/'.$file_name.'.txt';
        $this->file_url  = $upload_dir['baseurl'].'/logs/'.$file_name.'.txt';

        $this->create_log_file( $new_file );
    }

    private function create_log_file( $new_file ){
        if( $new_file ){
            $fh = fopen( $new_file , 'w' );
            fclose($fh);
        }
        if( ! file_exists( $this->file_path ) ){
            file_put_contents( $this->file_path , "\xEF\xBB\xBF" );
        }

        $filesize = filesize( $this->file_path );
        $filesize = round( $filesize / 1024 / 1024, 1);

        if( $filesize > 2 ){
            rename( $this->filename , $this->filename.'-'.date('d.m.Y-H:i') );
        }
    }

    public function log( $row ){
        if( file_exists( $this->file_path ) ){
            file_put_contents( $this->file_path , $row."\r\n" , FILE_APPEND );
        }

    }

    public function get_file_url(){
        return add_query_arg( 'log' , $this->filename , home_url() );
    }

    public static function view_log(){
        if( isset( $_GET['log'] ) ){
            if( current_user_can('administrator') ){
                $upload_dir = wp_upload_dir();

                $file = isset( $_GET['log'] ) ? $_GET['log'] : '';

                $file_path = $upload_dir['basedir'].'/logs/'.$file.'.txt';

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . $file.'.txt');
                header('Content-Transfer-Encoding: binary');
                header('Connection: Keep-Alive');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');

                echo file_get_contents( $file_path );
                die();
            }else{
                wp_die('You need to be logged in');
            }
        }
    }
}

add_action( 'init' , array( 'QS_logger' , 'view_log' ) );
