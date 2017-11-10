<div class="videocall-wrap">
	<div class="container-fluid">
			<!-- CHAT PANEL-->
			<div class="chat-pane">
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
			</div>
			<!-- / CHAT PANEL -->
			<div class="calling-receiving-window">
				<div class="calling-wrap">
					<div id="callModal" class="calling-wrap-inner">
						<div class="modal-content text-center">
							<div class="modal-header" id="callerInfo"></div>
							<div class="modal-body">
								<button type="button" class="btn btn-danger btn-sm" id='endCall'>
									<i class="fa fa-times-circle"></i> End Call
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="receiving-wrap">
					<div id="rcivModal" class="receiving-wrap-inner">
						<div class="modal-content">
							<div class="modal-header" id="calleeInfo"></div>

							<div class="modal-body text-center">
								<button type="button" class="btn btn-success btn-sm answerCall" id='startAudio'>
									<i class="fa fa-phone"></i> Audio Call
								</button>
								<button type="button" class="btn btn-success btn-sm answerCall" id='startVideo'>
									<i class="fa fa-video-camera"></i> Video Call
								</button>
								<button type="button" class="btn btn-danger btn-sm" id='rejectCall'>
									<i class="fa fa-times-circle"></i> Reject Call
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- / .calling-receiving-window -->
			
			<div class="video-on-call-wrap">
				<!-- Remote Video -->
					<div class="remote-video-wrap">
						<video id="peerVid"  playsinline autoplay></video>
					</div>
				<!-- Remote Video -->
				
				<!-- Local Video -->
					<div class="local-video-wrap">
						<video id="myVid"  muted autoplay></video>
					</div>
				<!-- Local Video -->
				<button class="btn btn-danger btn-sm" id="terminateCall" disabled><i class="fa fa-phone-square"></i></button>	
			</div>
			
			
	</div>
	
	
</div>