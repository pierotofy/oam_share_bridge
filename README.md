# OAM Share Bridge
A simple set of scripts to temporarily host GeoTIFFs on a public URL for sharing to OpenAerialMap.

## Installation

Load on any machine that has Apache2 and PHP 7+.

```bash
cd /var/www
git clone https://github.com/pierotofy/oam_share_bridge
```

## Endpoints

 - `/upload`
 - `/download/<file>`
 - `/cleanup/<file>`
 
 Only GeoTIFFs are allowed. Some checks on free disk space are also performed. `/download` automatically removes the requested file if the file is downloaded with cURL. All files are automatically removed after a set amount of time.
 
 This is experimental, use at your own risk.
