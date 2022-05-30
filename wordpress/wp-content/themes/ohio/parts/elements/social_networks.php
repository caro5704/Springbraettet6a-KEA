<?php
    while ( have_rows( 'global_header_menu_social_links', 'option' ) ) :
        the_row();

        $_network_field = get_sub_field( 'social_network' );
        printf( '<a href="%s" target="%s" class="network -unlink %s">', esc_url( get_sub_field( 'url' ) ), '_blank', esc_attr( $_network_field ) );

        switch ( $_network_field ) {
			case 'artstation':     echo '<i class="fab fa-artstation"></i>';      break;
			case 'behance':     echo '<i class="fab fa-behance"></i>';      break;
			case 'deviantart':     echo '<i class="fab fa-deviantart"></i>';      break;
            case 'digg':        echo '<i class="fab fa-digg"></i>';         break;
            case 'discord':        echo '<i class="fab fa-discord"></i>';         break;
            case 'dribbble':    echo '<i class="fab fa-dribbble"></i>';     break;
            case 'facebook':    echo '<i class="fab fa-facebook-f"></i>';   break;
            case 'flickr':      echo '<i class="fab fa-flickr"></i>';       break;
            case 'github':      echo '<i class="fab fa-github-alt"></i>';   break;
            case 'instagram':   echo '<i class="fab fa-instagram"></i>';    break;
            case 'kaggle':   echo '<i class="fab fa-kaggle"></i>';    break;
            case 'linkedin':    echo '<i class="fab fa-linkedin"></i>';     break;
            case 'medium':    echo '<i class="fab fa-medium-m"></i>';     break;
            case 'mixer':   echo '<i class="fab fa-mixer"></i>';   break;
            case 'pinterest':   echo '<i class="fab fa-pinterest"></i>';    break;
            case 'quora':       echo '<i class="fab fa-quora"></i>';        break;
            case 'reddit':      echo '<i class="fab fa-reddit-alien"></i>'; break;
            case 'snapchat':    echo '<i class="fab fa-snapchat"></i>';     break;
            case 'soundcloud':    echo '<i class="fab fa-soundcloud"></i>';     break;
            case 'spotify':    echo '<i class="fab fa-spotify"></i>';     break;
            case 'teamspeak':    echo '<i class="fab fa-teamspeak"></i>';     break;
            case 'telegram':    echo '<i class="fab fa-telegram-plane"></i>';     break;
            case 'tiktok':   echo '<i class="fab fa-tiktok"></i>';   break;
            case 'tripadvisor':   echo '<i class="fab fa-tripadvisor"></i>';   break;
            case 'tumblr':     echo '<i class="fab fa-tumblr"></i>';      break;
            case 'twitch':   echo '<i class="fab fa-twitch"></i>';   break;
            case 'twitter':     echo '<i class="fab fa-twitter"></i>';      break;
            case 'vimeo':       echo '<i class="fab fa-vimeo"></i>';        break;
            case 'vine':        echo '<i class="fab fa-vine"></i>';         break;
            case 'whatsapp':    echo '<i class="fab fa-whatsapp"></i>';     break;
            case 'xing':    echo '<i class="fab fa-xing"></i>';     break;
            case 'youtube':     echo '<i class="fab fa-youtube"></i>';      break;
            case '500px':     echo '<i class="fab fa-500px"></i>';      break;
        }

        echo '</a>';
    endwhile;
?>