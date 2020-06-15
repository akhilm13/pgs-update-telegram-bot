<?php
/**
 * Created by PhpStorm.
 * User: akmur
 * Date: 15-06-2020
 * Time: 00:24
 */

class PollWordPressRSSFeed
{

    private $wordpressUrl = 'https://possiblygoodstuff.wordpress.com/feed/';
    private $numberOfPosts = 0;
    private $links = array();

    public function __construct(){
    
		$this->getLinksFromRssFeed();
    }   

    private function getLinksFromRssFeed()
    {

        $feed = simplexml_load_file($this->wordpressUrl);

        $items = array();
        if ($feed && isset($feed->channel) && isset($feed->channel->item)) {

            $items = $feed->channel->item;
        }

        foreach ($items as $item) {
            $this->links[] = $item->link;
        }

        $this->numberOfPosts = count($this->links);
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    public function getLatestLink()
    {
        if (!empty($this->links)) {
            return $this->links[0];
        }

        return '';
    }


}
