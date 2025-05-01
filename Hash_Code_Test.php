<?php

$video_id = "nLpU37AZKBa";
$hash = 'b76a9a899622597fcd8ea25e6f85baff';
            // Generate hash code
            $hash_code = '';
            for ($i = 0; $i < 4; $i++) {
                $part = substr($hash, $i * 8, 8);
                $hash_code .= base_convert($part, 16, 36);
            }

echo $load_url = "https://www.eporner.com/xhr/video/{$video_id}?hash={$hash_code}&device=generic&domain=www.eporner.com&fallback=false&embed=false&supportedFormats=hls"; //supportedFormats [mp4, hls]


/*
JSON OUTPUT
{
  "vid": "nLpU37AZKBa",
  "videoFID": 10759617,
  "watchId": "S3cPoCSdv4hUsfZCiFNxJh0qaTSpMuek",
  "available" : true,
  "fallback" : false,
  "code": 0,
  "message" : "",
  "sources": {
    "mp4": {
    
      "720p HD": {
      "labelShort": "720p",
      "src": "https://vid-s3-c50-de-cdn.eporner.com/v7/WCF03o4URChAE2QMlJ0Fmg/1746057438_2001:b07:6469:19e7:55a7:6950:8072:e5a1_322/10759617-720p.mp4",
        "type": "video/mp4",
        "default": true        
      },    
      "480p": {
      "labelShort": "480p",
      "src": "https://vid-s3-c50-de-cdn.eporner.com/v7/WCF03o4URChAE2QMlJ0Fmg/1746057438_2001:b07:6469:19e7:55a7:6950:8072:e5a1_322/10759617-480p.mp4",
        "type": "video/mp4",
        "default": false        
      },    
      "360p": {
      "labelShort": "360p",
      "src": "https://vid-s3-c50-de-cdn.eporner.com/v7/WCF03o4URChAE2QMlJ0Fmg/1746057438_2001:b07:6469:19e7:55a7:6950:8072:e5a1_322/10759617-360p.mp4",
        "type": "video/mp4",
        "default": false        
      },    
      "240p": {
      "labelShort": "240p",
      "src": "https://vid-s3-c50-de-cdn.eporner.com/v7/WCF03o4URChAE2QMlJ0Fmg/1746057438_2001:b07:6469:19e7:55a7:6950:8072:e5a1_322/10759617-240p.mp4",
        "type": "video/mp4",
        "default": false        
      }    }
          },
  "backupServers": [null],
  "backupServersHls": [null],
  "volPrefixes": [],
  "volPrefixesHls": [],
    "lastSpeed": 8850000,
    "vtt": "https://static-eu-cdn.eporner.com/thumbs/static4/1/10/107/10759617/tiles.vtt",
  "activeLimits": 0,
  "dashReport": "minimal",   "hlsReport": "minimal",   "volume": 1,
  "inplayer": {
    "active": true,
    "src": "/dot/inplayer.php",
    "width": 300,
    "height": 250
  },
  "inplayerLink": {
    "active": true,
    "endpointURL": "/dot/dot.php?v=2"
  },
  "vast": {
    "active": true,
    "tag": "https:\/\/www.eporner.com\/xhr\/vast\/",
    "timeout": 5000,
    "maxSkipOffset": 10
  },
  "netblock": null,
  "speedtest": {
    "speed": 0,
    "avgspeed": 0    }

}
*/