deploy_stage:
	rsync --checksum --links --exclude-from=rsync_excludes -v -r -e 'ssh -p 2222' ./ root@37.235.120.34:/var/www/vhosts/beta.submissiontechnology.co.uk/httpdocs
