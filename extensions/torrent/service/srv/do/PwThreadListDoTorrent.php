<?php
defined('WEKIT_VERSION') or exit(403);
Wind::import('SRV:forum.srv.threadList.do.PwThreadListDoBase');

class PwThreadListDoTorrent extends PwThreadListDoBase
{
    
    public function __construct() {
    }
    
    public function bulidThread($thread) {
        if (isset($thread['special']) && $thread['special'] == 'torrent' && Wekit::C('site','theme.site.default') == 'pt' && !empty(Wekit::C('site','app.torrent.theme.showpeers'))) {
            $torrent = Wekit::load('EXT:torrent.service.PwTorrent')->getTorrentByTid($thread['tid']);
            $peers = Wekit::load('EXT:torrent.service.PwTorrentPeer')->getTorrentPeerByTorrent($torrent['id']);
            $seeder = $leecher = 0;
            foreach ($peers as $peer) {
                if ($peer['seeder'] == 'yes') {
                    $seeder++;
                } else {
                    $leecher++;
                }
            }
            $thread['seeder'] = $seeder;
            $thread['leecher'] = $leecher;
        }
        return $thread;
    }
}
?>