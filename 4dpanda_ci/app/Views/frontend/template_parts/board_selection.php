    <div id="board-selection-menu" class="" style="display:none;">
		<div class="container">
			<div class="center-header-1">
				<div class="menu-box">
					<div class="menu-hider"></div>
					<div class="mobile-h-scroller-hint"><img src="<?php echo base_url("/assets/images/boards-images/h-scrolling.gif"); ?>" alt="scroll"></div>
					<nav class="menu">
						<a href="#" class="board-item" data-board-code="magnum">
							<img src="<?php echo base_url("/assets/images/boards-images/magnum.png"); ?>" width="35px" height="35px" alt="Magnum">
						</a>
						<a href="#" class="board-item" data-board-code="damacai">
							<img src="<?php echo base_url("/assets/images/boards-images/damacai.png"); ?>" width="35px" height="35px" alt="Damacai">
						</a>
						<a href="#" class="board-item active" data-board-code="toto">
							<img src="<?php echo base_url("/assets/images/boards-images/toto.png"); ?>" width="35px" height="35px" alt="Sport Toto">
						</a>
						<a href="#" class="board-item" data-board-code="camg">
							<img src="<?php echo base_url("/assets/images/boards-images/gd.png"); ?>" width="35px" height="35px" alt="GD">
						</a>
						<a href="#" class="board-item" data-board-code="camp">
							<img src="<?php echo base_url("/assets/images/boards-images/perdana.png"); ?>" width="35px" height="35px" alt="Perdana">
						</a>
						<a href="#" class="board-item" data-board-code="9lotto">
							<img src="<?php echo base_url("/assets/images/boards-images/9lotto.png"); ?>" width="40px" height="35px" alt="Nine Lotto">
						</a>
						<a href="#" class="board-item" data-board-code="camh">
							<img src="<?php echo base_url("/assets/images/boards-images/lucky.webp"); ?>" width="40px" height="35px" alt="Lucky Hari Hari">
						</a>
						<a href="#" class="board-item" data-board-code="st">
							<img src="<?php echo base_url("/assets/images/boards-images/sandakan.png"); ?>" width="35px" height="35px" alt="Sandakan">
						</a>
						<a href="#" class="board-item" data-board-code="sw">
							<img src="<?php echo base_url("/assets/images/boards-images/sarawak.png"); ?>" width="35px" height="35px" alt="Sarawak">
						</a>
						<a href="#" class="board-item" data-board-code="sb">
							<img src="<?php echo base_url("/assets/images/boards-images/sabah88.png"); ?>" width="35px" height="35px" alt="Sabah 88">
						</a>
						<a href="#" class="board-item" data-board-code="sg4d">
							<img src="<?php echo base_url("/assets/images/boards-images/singapore.png"); ?>" width="35px" height="35px" alt="SingaporePools 4D">
						</a>
                        <a href="#" class="board-item" data-board-code="lmc">
							<img src="<?php echo base_url("/assets/images/boards-images/lottomacaologo.png"); ?>" width="35px" height="35px" alt="Lotto Macao">
						</a>
						<a href="#" class="board-item" data-board-code="mth">
							<img src="<?php echo base_url("/assets/images/boards-images/mataharilogo.png"); ?>" width="35px" height="35px" alt="Matahari">
						</a>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="center-header" style="text-align: center; margin-top:10px;">
				<?php if(isset($special_draws)):?>
					<?php
						// Tách chuỗi ngày thành mảng
						$dates = explode(';', $special_draws['option_value']);
						// Lấy ngày hiện tại
						$today = new DateTime();
						$closestDate = null;

						foreach ($dates as $dateStr) {
							// Bỏ qua giá trị trống (nếu có)
							if (empty(trim($dateStr))) continue;
							
							$date = DateTime::createFromFormat('Y-m-d', trim($dateStr));
							
							// Chỉ xử lý các ngày hợp lệ và trong tương lai
							if ($date && $date >= $today) {
								if (!$closestDate || $date < $closestDate) {
									$closestDate = $date;
								}
							}
						}

						if ($closestDate) {
							echo "<span>Next Special Draws: ".$closestDate->format('d-m-Y (D)') ."</span> | ";
						}
						?>
				<?php endif;?>
				<span>Last Updated: <?php  
					date_default_timezone_set('Asia/Singapore');    
					$currentDateTime = new DateTime();
					echo $currentDateTime->format('d-m-Y H:i:s');
					?>
				</span>
		</div>