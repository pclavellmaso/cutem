<?php

add_filter( 'woocommerce_email_attachments', 'facturas_emails_woo', 10, 4 );
function facturas_emails_woo( $attachments, $email_id, $order, $email ) {
    $email_ids = array( 'customer_completed_order' );
    if ( in_array ( $email_id, $email_ids ) ) {

        $upload_dir = wp_upload_dir();
        //$attachments[] = $upload_dir['basedir'] . "/81268.pdf";
        $attachments[] = $upload_dir['basedir'] .'/'. $order->get_id().'.pdf';
    }
    return $attachments;
}

