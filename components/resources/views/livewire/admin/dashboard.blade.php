<div>

		<div class="row mb-3">
		 <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
		    <div class="card card-sm">
		       <div class="card-body">
		           <div class="row align-items-center">
		               <div class="col">
		                   <div class="font-weight-bold">{{ __('Today') }}</div>
		                   <div class="text-muted">
		                       {{ $today }}
		                   </div>
		               </div>

		               <div class="col-auto">
		               	<div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
		               		<i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
		               	</div>
		               </div>
		           </div>
		       </div>
		    </div>
		 </div>
		 <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
		    <div class="card card-sm">
		       <div class="card-body">
		           <div class="row align-items-center">
		               <div class="col">
		                   <div class="font-weight-bold">{{ __('This Week') }}</div>
		                   <div class="text-muted">
		                      {{ $thisWeek }}
		                   </div>
		               </div>

		               <div class="col-auto">
			               	<div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
			               		<i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
			               	</div>
		               </div>
		           </div>
		       </div>
		    </div>
		 </div>
		 <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
		    <div class="card card-sm">
		       <div class="card-body">
		           <div class="row align-items-center">
		               <div class="col">
		                   <div class="font-weight-bold">{{ __('Last 30 Days') }}</div>
		                   <div class="text-muted">
		                       {{ $last30Days }}
		                   </div>
		               </div>

		               <div class="col-auto">
			               	<div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
			               		<i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
			               	</div>
		               </div>
		           </div>
		       </div>
		    </div>
		 </div>
		 <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
		    <div class="card card-sm">
		       <div class="card-body">

		           <div class="row align-items-center">
		               <div class="col">
		                   <div class="font-weight-bold">{{ __('All Time') }}</div>
		                   <div class="text-muted">
		                       {{ $allTime }}
		                   </div>
		               </div>

		               <div class="col-auto">
			               	<div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
			               		<i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
			               	</div>
		               </div>
		           </div>
		       </div>
		    </div>
		 </div>
		</div>

		<div class="row mb-3">
		  <div class="col">
		      <div class="card">
		          <div class="card-body">
		              <h6 class="text-capitalize">{{ __('Traffic summary') }}</h6>
		              <div class="chart" wire:ignore>
		                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
		              </div>
		          </div>
		      </div>
		  </div>
		</div>

		<div class="row mb-3">
			<div class="col col-md-6 mb-3">
				<div class="card">
					<div class="d-block card-header category-box text-start bg-gradient-primary text-white">
						<h6 class="text-white mb-0 text-capitalize">{{ __('Traffic per tool (Updated daily)') }}</h6>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table align-items-center table-hover">
								<thead>
									<tr>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Tool name') }}</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Total views') }}</th>
									</tr>
								</thead>
								<tbody>
									@if ( $countPerTool->isNotEmpty() )

										@foreach ($countPerTool as $element)
											<tr>
												<td class="align-middle">
													<div class="d-flex px-2">
														<div class="my-auto">
															{{ $element['tool_name'] }}
														</div>
													</div>
												</td>
												<td class="align-middle">{{ $element['count'] }}</td>
											</tr>
										@endforeach

									@else
										<tr>
											<td class="align-middle" colspan="2">{{ __('No record found') }}</td>
										</tr>
									@endif

								</tbody>
							</table>
						</div>

						<div class="float-end mt-3">
							{{ $countPerTool->links() }}
						</div>

					</div>
				</div>
			</div>

			<div class="col col-md-6">
				<div class="card">
					<div class="d-block card-header category-box text-start bg-gradient-primary text-white">
						<h6 class="text-white mb-0 text-capitalize">{{ __('New user history') }}</h6>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table align-items-center table-hover">
								<thead>
									<tr>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Full name') }}</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Email') }}</th>
										<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ __('Join date') }}</th>
									</tr>
								</thead>
								<tbody>
									@if ( !empty($users) )

										@foreach ($users as $user)
											<tr>
												<td class="align-middle">
													<div class="d-flex px-2">
														<div class="my-auto">
															{{ $user['fullname'] }}
														</div>
													</div>
												</td>
												<td class="align-middle">{{ $user['email'] }}</td>
												<td class="align-middle">{{ $user['created_at'] }}</td>
											</tr>
										@endforeach

									@else
										<tr>
											<td class="align-middle">{{ __('No record found') }}</td>
										</tr>
									@endif

								</tbody>
							</table>
						</div>

						<div class="float-end mt-3">
							{{ $users->links() }}
						</div>

					</div>
				</div>
			</div>
		</div>

		<script src="{{ asset('assets/js/chartjs.min.js') }}"></script>
  		<script>
   	      var ctx2 = document.getElementById("chart-line").getContext("2d");
	      
	      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
	      
	      gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
	      gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
	      gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)'); //purple colors

	      new Chart(ctx2, {
	        type: "line",
	        data: {
	          labels: [
	            @foreach ($getAllDays as $day)
	              "{{ $day['date'] }}",
	            @endforeach
	          ],
	          datasets: [{
	            label: "{{ __('Total views') }}",
	            tension: 0.4,
	            borderWidth: 0,
	            pointRadius: 0,
	            borderColor: "#5e72e4",
	            borderWidth: 3,
	            backgroundColor: gradientStroke1,
	            data: [
	              @foreach ($toolPerDay as $download)
	                "{{ $download['history'] }}",
	              @endforeach
	            ],
	            maxBarThickness: 6

	          }
	          ],
	        },
	        options: {
	          responsive: true,
	          maintainAspectRatio: false,
	          legend: {
	            display: false,
	          },
	          tooltips: {
	            enabled: true,
	            mode: "index",
	            intersect: false,
	          },
	          scales: {
	            yAxes: [{
	              gridLines: {
	                borderDash: [5, 5],
	                color: '#dee2e6',
	                zeroLineColor: '#dee2e6',
	                zeroLineWidth: 1,
	                zeroLineBorderDash: [2],
	                drawBorder: false,
	              },
	              ticks: {
	                suggestedMin: 0,
	                suggestedMax: {{ $getMaxViews }},
	                beginAtZero: true,
	                padding: 10,
	                fontSize: 11,
	                fontColor: '#ccc',
	                lineHeight: 3,
	                fontStyle: 'normal',
	                fontFamily: "Open Sans",
	              },
	            }, ],
	            xAxes: [{
	              gridLines: {
	                zeroLineColor: 'rgba(0,0,0,0)',
	                display: false,
	              },
	              ticks: {
	                padding: 10,
	                fontSize: 11,
	                fontColor: '#ccc',
	                lineHeight: 3,
	                fontStyle: 'normal',
	                fontFamily: "Open Sans",
	              },
	            }, ],
	          },
	        },
	      });
  		</script>

</div>