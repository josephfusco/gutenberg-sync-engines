<?php
/**
 * WP_Sync_Mailbox_Backend interface
 *
 * @package gutenberg-sync-engines
 */

if ( ! interface_exists( 'WP_Sync_Mailbox_Backend' ) ) {
	/**
	 * A store for the WebRTC handshake messages waiting for a tab, plugged
	 * in via the `wp_sync_mailbox_backend` filter. The default is one
	 * options row per tab.
	 *
	 * Concurrent sends must all land, `take` returns oldest first and
	 * removes what it returns, and a backend expires messages itself.
	 * Callers have already authorized the room.
	 *
	 * @since n.e.x.t
	 */
	interface WP_Sync_Mailbox_Backend {
		/**
		 * Files messages for one recipient.
		 *
		 * @since n.e.x.t
		 *
		 * @param string                           $room       Room identifier.
		 * @param string                           $to         The recipient's token.
		 * @param array<int, array<string, mixed>> $messages   Messages, oldest first.
		 * @param int                              $user_id    The sender's user.
		 * @param int                              $expires_in Seconds a message waits.
		 * @return void
		 */
		public function send( string $room, string $to, array $messages, int $user_id, int $expires_in ): void;

		/**
		 * Removes and returns one recipient's messages.
		 *
		 * @since n.e.x.t
		 *
		 * @param string $room       Room identifier.
		 * @param string $to         The recipient's token.
		 * @param int    $expires_in Seconds a message waits.
		 * @return array<int, array<string, mixed>> Messages, oldest first.
		 */
		public function take( string $room, string $to, int $expires_in ): array;

		/**
		 * Deletes one recipient's messages.
		 *
		 * @since n.e.x.t
		 *
		 * @param string $room Room identifier.
		 * @param string $to   The recipient's token.
		 * @return void
		 */
		public function clear( string $room, string $to ): void;
	}
}
