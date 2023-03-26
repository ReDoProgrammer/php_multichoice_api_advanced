<?php include_once('./layouts/head.php') ?>
<!-- Body Wrap  -->
<div id="main">
	<?php include_once('./layouts/header.php') ?>
	<?php include_once('./layouts/sidebar.php') ?>





	<!-- Main Wrapper -->
	<section id="content_wrapper">

		<!-- Topbar Menu Wrapper -->
		<div id="topbar-dropmenu-wrapper">
			<div class="topbar-menu row">
				<div class="col-xs-4 col-sm-2">
					<a href="#" class="service-box bg-danger">
						<span class="fa fa-music"></span>
						<span class="service-title">Audio</span>
					</a>
				</div>
				<div class="col-xs-4 col-sm-2">
					<a href="#" class="service-box bg-success">
						<span class="fa fa-picture-o"></span>
						<span class="service-title">Images</span>
					</a>
				</div>
				<div class="col-xs-4 col-sm-2">
					<a href="#" class="service-box bg-primary">
						<span class="fa fa-video-camera"></span>
						<span class="service-title">Videos</span>
					</a>
				</div>
				<div class="col-xs-4 col-sm-2">
					<a href="#" class="service-box bg-alert">
						<span class="fa fa-envelope"></span>
						<span class="service-title">Messages</span>
					</a>
				</div>
				<div class="col-xs-4 col-sm-2">
					<a href="#" class="service-box bg-system">
						<span class="fa fa-cog"></span>
						<span class="service-title">Settings</span>
					</a>
				</div>
				<div class="col-xs-4 col-sm-2">
					<a href="#" class="service-box bg-dark">
						<span class="fa fa-user"></span>
						<span class="service-title">Users</span>
					</a>
				</div>
			</div>
		</div>
		<!-- /Topbar Menu Wrapper -->

		<!-- Topbar -->
		<header id="topbar" class="alt">
			<div class="topbar-left">
				<ol class="breadcrumb">
					<li class="breadcrumb-link">
						<a href="index.html">Home</a>
					</li>
					<li class="breadcrumb-current-item">Dashboard</li>
				</ol>
			</div>
		</header>
		<!-- /Topbar -->

		<div class="greeting-field">
			Welcome back, <span>Douglas</span>!
		</div>

		<!-- Content -->
		<section id="content" class="table-layout animated fadeIn">

			<!-- Column Center -->
			<div class="chute chute-center">

				<!-- AllCP Info -->
				<div class="allcp-panels fade-onload">

					<div class="row">
						<!-- AllCP Grid -->
						<div class="col-md-12 allcp-grid">

							<!-- Perfomance -->
							<div class="panel mb10" data-panel-title="false">
								<div class="text-dark fs24 fw700 mb20">
									Performance
								</div>
								<div class="panel-body mtn pn">
									<div class="row">
										<!-- Chart -->
										<div class="col-md-12 phn mb10">
											<div id="high-area" style="" class="pln prn high-area-style-1"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /AllCP Grid -->
					</div>

					<!-- Quick Links -->
					<div class="row">
						<div class="col-sm-6 col-md-3 col-xl-3">
							<div class="panel panel-tile info-block">
								<div class="panel-body">
									<div class="info-block-top">
										<i class="icon-tool text-dark"></i>
										<div class="text-danger">
											<i class="fa fa-caret-down"></i>
											<span>15.7%</span>
										</div>
									</div>
									<div class="info-block-middle text-center">
										<h2>6.794</h2>

									</div>
									<div class="info-block-bottom text-center">
										<h6>Tickets Answered</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-xl-3">
							<div class="panel panel-tile info-block">
								<div class="panel-body">
									<div class="info-block-top">
										<i class="icon-social text-dark"></i>
										<div class="text-info">
											<i class="fa fa-caret-up"></i>
											<span>20.2%</span>
										</div>
									</div>
									<div class="info-block-middle text-center">
										<h2>457</h2>

									</div>
									<div class="info-block-bottom text-center">
										<h6>New Visitors</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-xl-3">
							<div class="panel panel-tile info-block">
								<div class="panel-body">
									<div class="info-block-top">
										<i class="icon-transport text-dark"></i>
										<div class="text-info">
											<i class="fa fa-caret-up"></i>
											<span>5.7%</span>
										</div>
									</div>
									<div class="info-block-middle text-center">
										<h2>1678</h2>

									</div>
									<div class="info-block-bottom text-center">
										<h6>Projects Launched</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-xl-3">
							<div class="panel panel-tile info-block">
								<div class="panel-body">
									<div class="info-block-top">
										<i class="icon-check text-dark"></i>
										<div class="text-info">
											<i class="fa fa-caret-up"></i>
											<span>5.3%</span>
										</div>
									</div>
									<div class="info-block-middle text-center">
										<h2>5627</h2>

									</div>
									<div class="info-block-bottom text-center">
										<h6>Orders</h6>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-lg-4 col-custom-section">

							<!-- Poll -->
							<div class="panel pn" id="spy1">
								<div class="panel-heading ">
									<i class="icon-graphic-1"></i>
									<span class="panel-title">Poll</span>
								</div>
								<div class="panel-body p20 pb25 br-t">

									<div id="donut-chart1" style="height: 350px; width: 100%;"></div>

								</div>
								<div class="panel-body mtn pt30 pr10 pb25 pl15 poll-legend-bg-grey">
									<div class="col-sm-9 col-md-8 col-lg-7 col-custom xsmb15">
										<div class="radio-custom radio-warning">
											<input type="radio" id="browser1" name="radioExample">
											<label for="browser1">Option 1: Google Chrome</label>
										</div>
										<div class="radio-custom radio-alert">
											<input type="radio" id="browser2" name="radioExample">
											<label for="browser2">Option 2: Mozilla FireFox</label>
										</div>
										<div class="radio-custom radio-info">
											<input type="radio" id="browser3" name="radioExample">
											<label for="browser3">Option 3: Microsoft IE</label>
										</div>
									</div>
									<div class="col-sm-3 col-md-4 col-lg-5 col-custom xsmb15">
										<div class="text-right xs-text-center text-center-responsive margin-responsive">
											<div class="btn btn-gradient-warning no-shadow mb10 xs-mbn ">
												VOTE
											</div>
											<div class="btn btn-gradient-grey no-shadow">
												Hide results
											</div>
										</div>
									</div>
								</div>

							</div>

							<!-- Veisitors Map -->
							<div class="panel bg-none no-boxshadow pn" id="spy15">
								<div class="panel-heading br5  bg-white">
									<i class="icon-flag"></i>
									<span class="panel-title">Visitors Map</span>
								</div>
								<div class="panel-body mtn pn">

									<div id="map1" style="width: 100%; height: 270px;"></div>

								</div>

							</div>
						</div>

						<div class="col-md-6 col-lg-4 col-custom-section">

							<!-- Traphic Sources -->
							<div class="panel pn" id="spy7">
								<div class="panel-heading ">
									<i class="icon-tool2"></i>
									<span class="panel-title">Traffic Source</span>
								</div>
								<div class="panel-body pt40 ph25 pb35 br-t">
									<div class="row">
										<div class="col-sm-4 text-center ph10 xsmb15">
											<div class="info-circle" id="c1" data-value="65" data-circle-color="info-dr"></div>
											<div class="text-muted fs18 fw500">Google</div>
										</div>
										<div class="col-sm-4 text-center ph10 xsmb15">
											<div class="info-circle" id="c2" data-value="15" data-circle-color="info-dr"></div>
											<div class="text-muted fs18 fw500">Bing</div>
										</div>
										<div class="col-sm-4 text-center ph10">
											<div class="info-circle" id="c3" data-value="40" data-circle-color="info-dr"></div>
											<div class="text-muted fs18 fw500">Twitter</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Server Status -->
							<div class="panel pn" id="spy10">
								<div class="panel-heading ">
									<i class="icon-graphic"></i>
									<span class="panel-title">Server Status</span>
								</div>
								<div class="panel-body pt40 ph30 pb25 br-t">
									<div class="progress progress-bar-lg br4 no-boxshadow">
										<div class="progress-bar progress-bar-gradient-info" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
											<span class="pull-left">Memory Used</span>
											<span class="pull-right ph10">55%</span>
										</div>
									</div>
									<div class="progress progress-bar-lg br4 no-boxshadow">
										<div class="progress-bar progress-bar-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
											<span class="pull-left">Disk dev/sda1</span>
											<span class="pull-right ph10">60%</span>
										</div>
									</div>
									<div class="progress progress-bar-lg br4 no-boxshadow">
										<div class="progress-bar progress-bar-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
											<span class="pull-left">Disk dev/sda2</span>
											<span class="pull-right ph10">80%</span>
										</div>
									</div>
									<div class="progress progress-bar-lg br4 no-boxshadow">
										<div class="progress-bar progress-bar-gradient-info" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
											<span class="pull-left">Disk dev/sda3</span>
											<span class="pull-right ph10">66%</span>
										</div>
									</div>
									<div class="progress progress-bar-lg br4 no-boxshadow">
										<div class="progress-bar progress-bar-gradient-info" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
											<span class="pull-left">Disk dev/sda4</span>
											<span class="pull-right ph10">45%</span>
										</div>
									</div>
									<div class="progress progress-bar-lg br4 no-boxshadow">
										<div class="progress-bar progress-bar-gradient-info" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%;">
											<span class="pull-left">Disk dev/sda5</span>
											<span class="pull-right ph10">78%</span>
										</div>
									</div>
								</div>
							</div>

							<!-- User Project List -->
							<div class="panel pn" id="spy6">
								<div class="panel-heading ">
									<i class="icon-clock"></i>
									<span class="panel-title">User Project List Schedule</span>
								</div>
								<div class="panel-body br-t pt20 ph30 bp25">
									<div class="bs-component">
										<div class="table-responsive">
											<table class="table table-striped table-style-1 btn-gradient-grey">
												<thead class="">
													<tr>
														<th class="">Project</th>
														<th class=" hidden-xs">Start Date</th>
														<th class="">Deadline</th>
														<th class="">Status</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="wp25">#4551</td>
														<td class="hidden-xs">10.02.2016</td>
														<td>10.02.2016</td>
														<td><span class="label label-info">in progress</span></td>
													</tr>
													<tr>
														<td class="">#4532</td>
														<td class="hidden-xs">23.12.2015</td>
														<td>11.01.2016</td>
														<td><span class="label label-primary">Done</span></td>
													</tr>
													<tr>
														<td class="">#4536</td>
														<td class="hidden-xs">16.05.2015</td>
														<td>18.06.2015</td>
														<td><span class="label label-danger">Failed</span></td>
													</tr>
													<tr>
														<td class="">#4552</td>
														<td class="hidden-xs">10.02.2016</td>
														<td>10.02.2016</td>
														<td><span class="label label-info">In Progress</span></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

						</div>


						<div class="col-md-6 col-lg-4 col-custom-section">
							<!-- Task-list -->
							<div class="panel panel-widget task-widget pn" id="spy11">
								<div class="panel-heading cursor ">
									<i class="icon-square1"></i>
									<span class="panel-title">Task-List Widget</span>
								</div>
								<div class="panel-body p30 br-t">

									<h6 class="text-muted mn mb20">
										<span class="pl5 ff-2nd">Personal Tasks</span>
									</h6>
									<ul class="task-list task-current mb25">
										<li class="task-item">
											<div class="task-handle">
												<div class="checkbox-custom">
													<input type="checkbox" id="task0">
													<label for="task0"></label>
												</div>
											</div>
											<div class="task-desc">
												Remove announcement
											</div>
											<div class="task-menu"></div>
										</li>
										<li class="task-item">
											<div class="task-handle">
												<div class="checkbox-custom">
													<input type="checkbox" id="task1">
													<label for="task1"></label>
												</div>
											</div>
											<div class="task-desc">
												Post an announcement
											</div>
											<div class="task-menu"></div>
										</li>
										<li class="task-item">
											<div class="task-handle">
												<div class="checkbox-custom">
													<input type="checkbox" id="task2">
													<label for="task2"></label>
												</div>
											</div>
											<div class="task-desc">
												Add new products
											</div>
											<div class="task-menu"></div>
										</li>
										<li class="task-item">
											<div class="task-handle">
												<div class="checkbox-custom">
													<input type="checkbox" id="task3">
													<label for="task3"></label>
												</div>
											</div>
											<div class="task-desc">
												Ban a few users
											</div>
											<div class="task-menu"></div>
										</li>
										<li class="task-item">
											<div class="task-handle">
												<div class="checkbox-custom">
													<input type="checkbox" id="task4">
													<label for="task4"></label>
												</div>
											</div>
											<div class="task-desc">
												Clean comments
											</div>
											<div class="task-menu"></div>
										</li>
									</ul>

									<h6 class="text-muted mn mb20">
										<span class="pl5 ff-2nd">Complete Tasks</span>
									</h6>
									<ul class="task-list task-completed">
										<li class="task-item item-checked">
											<div class="task-handle">
												<div class="checkbox-custom">
													<input type="checkbox" checked="" id="task7">
													<label for="task7"></label>
												</div>
											</div>
											<div class="task-desc">Add article review</div>
											<div class="task-menu"></div>
										</li>
										<li class="task-item item-checked">
											<div class="task-handle">
												<div class="checkbox-custom">
													<input type="checkbox" checked="" id="task8">
													<label for="task8"></label>
												</div>
											</div>
											<div class="task-desc">Add iPad review</div>
											<div class="task-menu"></div>
										</li>
										<li class="task-item item-checked">
											<div class="task-handle">
												<div class="checkbox-custom">
													<input type="checkbox" checked="" id="task9">
													<label for="task9"></label>
												</div>
											</div>
											<div class="task-desc">Ban THATuser user</div>
											<div class="task-menu"></div>
										</li>
									</ul>
								</div>

							</div>

							<!-- Column Graph -->
							<div class="panel pn" id="spy9">
								<div class="panel-heading ">
									<i class="icon-arrows"></i>
									<span class="panel-title">Traffic Source</span>
								</div>
								<div class="panel-body br-t">
									<div class="row mn">
										<div class="col-sm-5 prn mt50 xsmt25">
											<div class="progress progress-bar-lg br4 no-boxshadow mb15">
												<div class="progress-bar progress-bar-gradient-warning" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
													<span>Google</span>
												</div>
											</div>
											<div class="progress progress-bar-lg br4 no-boxshadow mb15">
												<div class="progress-bar progress-bar-gradient-info" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">
													<span>Bing</span>
												</div>
											</div>
											<div class="progress progress-bar-lg br4 no-boxshadow">
												<div class="progress-bar progress-bar-gradient-alert" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
													<span>Twitter</span>
												</div>
											</div>

										</div>
										<div class="col-sm-7 pl35 xsph10">
											<div class="allcp-form mt10">
												<!-- Block Widget -->
												<div class="smart-widget br-b sm-right">
													<label class="field">
														<input type="text" name="sub" id="sub" class="gui-input br-n pn" placeholder="Add Data Source">
													</label>
													<button type="submit" class="button br-n pn">
														<i class="allcp-icon-plus"></i>
													</button>
												</div>
											</div>
											<div class="legend-widget">
												<ul class="legend-list">
													<li class="legend-item danger">
														<div class="legend-handle">
															<i class="fa fa-circle fs21"></i>
														</div>
														<div class="legend-desc pl25">
															Google
															<span class="legend-date">85%</span>
														</div>
													</li>
													<li class="legend-item info">
														<div class="legend-handle">
															<i class="fa fa-circle fs21"></i>
														</div>
														<div class="legend-desc pl25">
															Bing
															<span class="legend-date">35%</span>
														</div>
													</li>
													<li class="legend-item alert">
														<div class="legend-handle">
															<i class="fa fa-circle fs21"></i>
														</div>
														<div class="legend-desc pl25">
															Twitter
															<span class="legend-date">65%</span>
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.col-md-6 -->


					</div>


				</div>


			</div>
			<!-- /Column Center -->

		</section>
		<!-- /Content -->



	</section>
	<!-- /Main Wrapper -->

</div>
<!-- /Body Wrap  -->

<?php include_once('./layouts/footer.php') ?>