<?php

/**
 * Notification Model
 */
class Notificationmodel extends CI_Model
{
	public function save_notification($noti)
	{
		$this->db->insert('notifications', $noti);
	}
}