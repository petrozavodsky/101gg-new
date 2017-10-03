<?php
/**
 * Build By:
 * www.CODEJA.net - Turning imagination into creation
 *
 * Team Member:
 * Full Name: Kirill Lavrishev
 * Contact Information: #0526142466 / k@codeja.net
 *
 * File Details:
 * Date of creation: 11-Dec-16 / 14:55
 * Last updated: 11-Dec-16 / 14:55 By Kirill Lavrishev
 *
 */

function get_the_odds_for_terms( $terms, $odds_to_give, $xml = 'http://oddsfeed1.bet365.com/Soccer.asp?EventGroupID=100100' ) {
// INIT
    $get_XML = simplexml_load_file($xml);
    $odds_to_give = $odds_to_give > 0 ? $odds_to_give - 1 : 0;
    $odds = [];


// LOOP THROUGH EVENTS
    foreach ( $get_XML->EventGroup->Event as $event ) {
        $event_id = (string) $event->attributes()['ID'];
        $results[$event_id] = array();

// REPLACE SMALL TEAM NAME TO REAL TEAM NAME
        if ( !$event->attributes()['Name'] ) {
            continue;
        }

        $title_match = $event->attributes()['Name'];
        $title_match = str_replace( 'Man Utd', 'Manchester United', $title_match );
        $title_match = str_replace( 'Man City', 'Manchester City', $title_match );
        $title_match = str_replace( 'Stoke', 'Stoke City', $title_match );
        $title_match = str_replace( 'West Brom', 'West Bromwich Albion', $title_match );
        $title_match = str_replace( 'Swansea', 'Swansea City', $title_match );
        $title_match = str_replace( 'Newcastle', 'Newcastle United', $title_match );
        $title_match = str_replace( 'Norwich', 'Norwich City', $title_match );
        $title_match = str_replace( 'Leicester', 'Leicester City', $title_match );
        $title_match = str_replace( 'West Ham', 'West Ham United', $title_match );
        $title_match = str_replace( 'Tottenham', 'Tottenham Hotspur', $title_match );

// EXPLODE TEAM NAMES TO GET 2 DIFFERENET TEAM
        $old_team_name = explode(' v ', $event->attributes()['Name']);
        $teams = explode(' v ', $title_match);

// IF TEAMS NOT EXIST IN THIS POST CONTINUE TO NEXT EVENT
        if ( !in_array(trim($teams[0]), $terms) && !in_array(trim($teams[1]), $terms) && !in_array(trim($old_team_name[0]), $terms) && !in_array(trim($old_team_name[1]), $terms)  ) {
            continue;
        }

        if ( in_array(trim($teams[0]), $terms) || in_array(trim($old_team_name[0]), $terms)  ) {
            $team_order_normal = true;
        } else if ( in_array(trim($teams[1]), $terms) || in_array(trim($old_team_name[1]), $terms) ) {
            $team_order_normal = false;
        }

        foreach ( $event->Market->Participant as $participant ) {
            $attributes = $participant->attributes();

            // IF HANDICAP CONTINUE TO NEXT $participant
            if ( $attributes['Handicap'] != '' ) {
                continue;
            }

            if ( $attributes['Name'] == 'Home Win' ) {
                $results[$event_id]['res1'] = $res1 = '<span>' .$teams[0] . ': '. $attributes['Odds'] . '</span>';
                $results[$event_id]['odds1'] = $odds1 = $attributes['Odds'];
                $results[$event_id]['id1'] = $id1 = $attributes['ID'];
            }
            if ( $attributes['Name'] == 'Draw' ) {
                $results[$event_id]['res2'] = $res2 = '<span>' . 'Draw: ' . $attributes['Odds'] . '</span>';
                $results[$event_id]['odds2'] = $odds2 = $attributes['Odds'];
                $results[$event_id]['id2'] = $id2 = $attributes['ID'];
            }
            if ( $attributes['Name'] == 'Away Win' ) {
                $results[$event_id]['res3'] = $res3 = '<span>' . $teams[1] .': '.$attributes['Odds']. '</span>';
                $results[$event_id]['odds3'] = $odds3 = $attributes['Odds'];
                $results[$event_id]['id3'] = $id3 =  $attributes['ID'];
            }
        }

        // COUNT IF ALL RESULTS EXIST FOR THIS EVENT (9), IF YES - ECHO
        if ( count($results[$event_id]) == 9 ) {
/*            $odds[] = '<a href="http://www.bet365.com/instantbet/default.asp?participantid='.$id1.'&odds='.$odd1.'&affiliatecode=365_099891&Instantbet=1" target="_blank" rel="nofollow">'.$res1.'</a>, '.'<a href="http://www.bet365.com/instantbet/default.asp?participantid='.$id2.'&odds='.$odd2.'&affiliatecode=365_099891&Instantbet=1" target="_blank" rel="nofollow">'.$res2.'</a> & '.'<a href="http://www.bet365.com/instantbet/default.asp?participantid='.$id3.'&odds='.$odd3.'&affiliatecode=365_099891&Instantbet=1" target="_blank" rel="nofollow"> '.$res3.'</a>';*/
           /* if ( $team_order_normal ) {
                $odds[] = '<a href="http://www.bet365.com/instantbet/default.asp?participantid='.$id1.'&odds='.$odd1.'&affiliatecode=365_099891&Instantbet=1" target="_blank" rel="nofollow">Grab '. $odds1 . ' ' . $teams[0] . ' to beat ' . $teams[1] . '</a>';
            } else {
                $odds[] = '<a href="http://www.bet365.com/instantbet/default.asp?participantid='.$id3.'&odds='.$odd3.'&affiliatecode=365_099891&Instantbet=1" target="_blank" rel="nofollow">Grab '. $odds3 . ' ' . $teams[1] . ' to beat ' . $teams[0] . '</a>';
            }*/



            if ( $team_order_normal ) {
                $variable = 'participantid='.$id1.'&odds='.$odds1.'&affiliatecode=365_099891&Instantbet=1';
                $variable = str_replace( '=', '___', $variable );
                $variable = str_replace( '&', '_CJ_', $variable );
                $variable = str_replace( '/', '_CJSLASH_', $variable );
                $odds[] = '<a href="' . home_url( '/outside/bet' ) . '/' . $variable . '" target="_blank" rel="nofollow">Grab '. $odds1 . ' on  ' . $teams[0] . ' to beat ' . $teams[1] . '</a>';
            } else {
                $variable = 'participantid='.$id3.'&odds='.$odds3.'&affiliatecode=365_099891&Instantbet=1';
                $variable = str_replace( '=', '___', $variable );
                $variable = str_replace( '&', '_CJ_', $variable );
                $variable = str_replace( '/', '_CJSLASH_', $variable );
                $odds[] = '<a href="' . home_url( '/outside/bet' ) . '/' . $variable . '" target="_blank" rel="nofollow">Grab '. $odds3 . ' on  ' . $teams[1] . ' to beat ' . $teams[0] . '</a>';
            }
        }
    }

    if ( count( $odds ) > 0 ) {
        $odds_output = '<div class="game-odds-for-tags"><h2>Winner Betting Odds</h2><ul class="list-unstyled">';
        for ( $i = 0; $i <= $odds_to_give; $i ++ ) {
            if ( $i >= count( $odds ) ) {
                break;
            }

            $odds_output .= '<li>' . $odds[ $i ] . '</li>';
        }
        $odds_output .= '</ul></div>';
    }

    return $odds_output;
}

function the_odds_for_terms( $terms, $odds_to_give, $xml = 'http://oddsfeed.bet365.com/Soccer.asp?EventGroupID=100100' ) {
    echo get_the_odds_for_terms( $terms, $odds_to_give, $xml );
}