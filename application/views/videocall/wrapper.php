<div class="videocall-wrap">
		<div class="container-fluid chat-pane">
			<!-- CHAT PANEL-->
			<div class="row chat-window col-xs-12 col-md-4">
				<div class="">
					<div class="panel panel-default chat-pane-panel">
						<div class="panel-heading chat-pane-top-bar">
							<div class="col-xs-6" style="margin-left:-20px">
								<i class="fa fa-comment" id="remoteStatus"></i> <span id=""><?php if(isset($chat_config) && isset($chat_config['remote'])){ echo $chat_config['remote']; } else { echo 'Remote'; }?></span>
								<b id="remoteStatusTxt">(Offline)</b>
							</div>
							<div class="col-xs-6 pull-right text-right">
								<div class="call-btns-wrap">
									<button class="btn btn-success btn-sm initCall" id="initAudio"><i class="fa fa-phone"></i></button>
									<button class="btn btn-info btn-sm initCall" id="initVideo"><i class="fa fa-video-camera"></i></button>
								</div>
								<span id="minim_chat_window" class="panel-collapsed fa fa-plus icon_minim pointer"></span>
							</div>
							<div class="clearfix clear"></div>
						</div>
						
						<div class="panel-body msg_container_base" id="chats"></div>
						
						<div class="panel-footer">
							<span id="typingInfo"></span>
							<div class="input-group">
								<input id="chatInput" type="text" class="form-control  chat_input" placeholder="Type message here...">
								<span class="input-group-btn">
									<button class="btn btn-primary " id="chatSendBtn">Send</button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- CHAT PANEL -->
		</div>
	

	
</div>