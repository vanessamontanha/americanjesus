<h2>View User</h2>

<dl>
	<dt>Email</dt>
	<dd><?php echo $user['User']['email']; ?>&nbsp;</dd>
	
	<dt>Admin</dt>
	<dd><?php echo $user['User']['admin']; ?>&nbsp;</dd>
	
	<dt>Created Date</dt>
	<dd><?php echo $this->Time->nice($user['User']['created']); ?>&nbsp;</dd>
</dl>