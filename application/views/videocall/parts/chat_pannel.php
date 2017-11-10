<div class="chat-pannel-wrap">
	<div class="panel panel-default chat-pane-panel">
		<div class="panel-heading chat-pane-top-bar">
			<div class="col-xs-10" style="margin-left:-20px">
				<i class="fa fa-comment" id="remoteStatus"></i> Remote
				<b id="remoteStatusTxt">(Offline)</b>
			</div>
			<div class="col-xs-2 pull-right">
				<span id="minim_chat_window" class="panel-collapsed fa fa-plus icon_minim pointer"></span>
			</div>
		</div>
		
		<div class="panel-body msg_container_base" id="chats"></div>
		
		<div class="panel-footer">
			<span id="typingInfo"></span>
			<div class="input-group">
				<input id="chatInput" type="text" class="form-control input-sm chat_input" placeholder="Type message here...">
				<span class="input-group-btn">
					<button class="btn btn-primary btn-sm" id="chatSendBtn">Send</button>
				</span>
			</div>
		</div>
	</div>
</div>