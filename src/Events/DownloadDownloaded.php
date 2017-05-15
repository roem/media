<?php namespace Roem\Media\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class DownloadDownloaded extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

}
