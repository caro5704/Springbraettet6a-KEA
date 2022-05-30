<?php
    $header_have_social = have_rows( 'global_header_menu_social_links', 'option' );
    $enable_social = OhioOptions::get_global( 'header_menu_social_links_visibility', true );
    if ( !$enable_social ) {
        $enable_social = OhioSettings::is_coming_soon_page();
    }

    $social_icons = OhioOptions::get_global( 'social_network_type', false );
    $in_new_tab = OhioOptions::get_global( 'social_network_target_blank', true );
    $links_target = ( $in_new_tab ) ? '_blank' : '_self';
    $social_classes = '';

    if ( $social_icons == 'icons') {
        $social_classes = 'icons';
    }
?>

<?php if ( $header_have_social && $enable_social): ?>

    <div class="social-bar dynamic-typo">
        <ul class="social-bar-holder titles-typo -small-t -unlist <?php echo esc_attr( $social_classes); ?>"> 
            <li><?php esc_html_e( 'Follow Us', 'ohio' ); ?></li>
            <li>—</li>
            <?php while( have_rows( 'global_header_menu_social_links', 'option' ) ): the_row(); ?>
                <?php switch ( get_sub_field( 'social_network' ) ) {
					case 'artstation':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash artstation">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-artstation'></i> " : esc_html_e( 'Art.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'behance':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash behance">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-behance'></i> " : esc_html_e( 'Be.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
					case 'deviantart':
						?>
						<li>
							<a target="<?php echo $links_target; ?>" href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash deviantart">
								<?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-deviantart'></i> " : esc_html_e( 'Dev.', 'ohio' ); ?>
							</a>
						</li>
						<?php 
						break;
                    case 'digg':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash digg">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-digg'></i> " : esc_html_e( 'Dg.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'discord':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash discord">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-discord'></i> " : esc_html_e( 'Ds.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'dribbble':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash dribbble">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-dribbble'></i> " : esc_html_e( 'Dr.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'facebook':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash facebook">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-facebook-f'></i> " : esc_html_e( 'Fb.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'flickr':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash flickr">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-flickr'></i> " : esc_html_e( 'Fl.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'github':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash github">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-github'></i> " : esc_html_e( 'Gh.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'instagram':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash instagram">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-instagram'></i> " : esc_html_e( 'Ig.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'kaggle':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash kaggle">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-kaggle'></i> " : esc_html_e( 'Ka.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'linkedin':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash linkedin">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-linkedin'></i> " : esc_html_e( 'Lk.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'medium':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash medium">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-medium-m'></i> " : esc_html_e( 'Md.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'mixer':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash mixer">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-mixer'></i> " : esc_html_e( 'Mx.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'pinterest':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash pinterest">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-pinterest'></i> " : esc_html_e( 'Pt.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'quora':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash quora">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-quora'></i> " : esc_html_e( 'Qu.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'reddit':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash reddit">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-reddit'></i> " : esc_html_e( 'Re.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'snapchat':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash snapchat">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-snapchat'></i> " : esc_html_e( 'Sn.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'soundcloud':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash soundcloud">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-soundcloud'></i> " : esc_html_e( 'Sc.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'spotify':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash spotify">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-spotify'></i> " : esc_html_e( 'Sp.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'teamspeak':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash teamspeak">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-teamspeak'></i> " : esc_html_e( 'Tm.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'telegram':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash telegram">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-telegram-plane'></i> " : esc_html_e( 'Tl.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'tiktok':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash tiktok">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-tiktok'></i> " : esc_html_e( 'Tk.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'tripadvisor':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash tripadvisor">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-tripadvisor'></i> " : esc_html_e( 'Ta.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'tumblr':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash tumblr">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-tumblr'></i> " : esc_html_e( 'Tm.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'twitch':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash twitch">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-twitch'></i> " : esc_html_e( 'Tw.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'twitter':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash twitter">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-twitter'></i> " : esc_html_e( 'Tw.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'vimeo':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash vimeo">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-vimeo'></i> " : esc_html_e( 'Vm.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'vine':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash vine">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-vine'></i> " : esc_html_e( 'Vn.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'whatsapp':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash whatsapp">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-whatsapp'></i> " : esc_html_e( 'Wh.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'xing':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash xing">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-xing'></i> " : esc_html_e( 'Xi.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'youtube':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash youtube">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-youtube'></i> " : esc_html_e( 'Yt.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break; 
                    case '500px':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ); ?>" class="-undash 500px">
                                <?php echo esc_html( $social_icons == 'icons') ? "<i class='fab fa-500px'></i> " : esc_html_e( '500px.', 'ohio' ); ?>
                            </a>
                        </li>
                        <?php 
                        break; 
                } ?>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>