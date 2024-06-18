@extends('Admin.layouts.main')
@section('content')
<style>
   section {
   margin-top: 30px;
   }
   .pieID {
   display: inline-block;
   vertical-align: top;
   }
   .pie {
   height: 200px;
   width: 200px;
   position: relative;
   margin: 0 30px 30px 0;
   }
   .pie::before {
   content: "";
   display: block;
   position: absolute;
   z-index: 1;
   width: 100px;
   height: 100px;
   background: #EEE;
   border-radius: 50%;
   top: 50px;
   left: 50px;
   }
   .pie::after {
   content: "";
   display: block;
   width: 120px;
   height: 2px;
   background: rgba(0,0,0,0.1);
   border-radius: 50%;
   box-shadow: 0 0 3px 4px rgba(0,0,0,0.1);
   margin: 220px auto;
   }
   .slice {
   position: absolute;
   width: 200px;
   height: 200px;
   clip: rect(0px, 200px, 200px, 100px);
   animation: bake-pie 1s;
   }
   .slice span {
   display: block;
   position: absolute;
   top: 0;
   left: 0;
   background-color: black;
   width: 200px;
   height: 200px;
   border-radius: 50%;
   clip: rect(0px, 200px, 200px, 100px);
   }
   .legend {
   list-style-type: none;
   padding: 0;
   margin: 0;
   font-size: 16px; 
   width: calc(100% - 240px);
   }
   .legend li {
   width: 100%;
   height: 1.25em;
   margin-bottom: 0.7em;
   padding-left: 0.5em;
   border-left: 1.25em solid black;
   }
   .legend em {
   font-style: normal;
   }
   .legend span {
   float: right;
   }
</style>
<main class="main2">
   <div class="page-profile">
      <p>Pages / Dashboard</p>
      <h1>Dashboard</h1>
   </div>
</main>
<main class="dashboard-main content-main-block">
   <div class="content-dashboard-wrap">
      <section class="user-booking-section">
         <div class="main-bar-list">
            <div class="main-bar-list-item sky-box">
               <div class="left-svg">
               <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
  <g clip-path="url(#clip0_323_1815)">
    <path d="M16.6734 15.6395C13.5672 14.8321 12.5682 13.9974 12.5682 12.6974C12.5682 11.2059 13.9503 10.1659 16.2629 10.1659C18.206 10.1659 19.1776 10.9048 19.5334 12.0816C19.6976 12.629 20.1492 13.0395 20.7239 13.0395H21.1344C22.0376 13.0395 22.6807 12.1501 22.366 11.3016C21.7913 9.68693 20.4502 8.3459 18.3155 7.8259V6.88171C18.3155 5.74593 17.3987 4.8291 16.2629 4.8291C15.1271 4.8291 14.2103 5.74593 14.2103 6.88171V7.78485C11.5556 8.35958 9.4209 10.0838 9.4209 12.7248C9.4209 15.8858 12.0345 17.4595 15.8524 18.3763C19.2734 19.1973 19.9576 20.4015 19.9576 21.6741C19.9576 22.6183 19.2871 24.1236 16.2629 24.1236C14.005 24.1236 12.8419 23.3162 12.3903 22.1668C12.1851 21.6331 11.7198 21.2499 11.1588 21.2499H10.7756C9.85879 21.2499 9.21564 22.1804 9.55774 23.0289C10.3377 24.9309 12.1577 26.053 14.2103 26.4909V27.4077C14.2103 28.5435 15.1271 29.4604 16.2629 29.4604C17.3987 29.4604 18.3155 28.5435 18.3155 27.4077V26.5183C20.9839 26.012 23.1049 24.4657 23.1049 21.6605C23.1049 17.7742 19.7797 16.4468 16.6734 15.6395Z" fill="#8CA521"/>
  </g>
  <defs>
    <clipPath id="clip0_323_1815">
      <rect width="32.8417" height="32.8417" fill="white" transform="translate(0.526367 0.724121)"/>
    </clipPath>
  </defs>
</svg>
               </div>
               <div class="total-booking">
                  <p>Income From Ads This Month</p>
               <h2 id="totalBookings">${{$thisMonthDealClosedSumFormatted}}</h2>
               </div>
            </div>
            <div class="main-bar-list-item sky-box">
               <div class="left-svg">
               <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
  <g clip-path="url(#clip0_125_1958)">
    <path d="M25.6663 6.04301L12.3547 19.3663L7.40801 14.4197L9.05301 12.7747L12.3547 16.0763L24.0213 4.40967L25.6663 6.04301ZM13.9997 23.333C8.85467 23.333 4.66634 19.1447 4.66634 13.9997C4.66634 8.85468 8.85467 4.66634 13.9997 4.66634C15.8313 4.66634 17.5463 5.20301 18.993 6.12467L20.6847 4.43301C18.783 3.11467 16.4847 2.33301 13.9997 2.33301C7.55967 2.33301 2.33301 7.55967 2.33301 13.9997C2.33301 20.4397 7.55967 25.6663 13.9997 25.6663C16.018 25.6663 17.9197 25.153 19.5763 24.243L17.8263 22.493C16.6597 23.0297 15.3647 23.333 13.9997 23.333ZM22.1663 17.4997H18.6663V19.833H22.1663V23.333H24.4997V19.833H27.9997V17.4997H24.4997V13.9997H22.1663V17.4997Z" fill="#8CA521"/>
  </g>
  <defs>
    <clipPath id="clip0_125_1958">
      <rect width="28" height="28" fill="white"/>
    </clipPath>
  </defs>
</svg>
               </div>
               <div class="total-booking">
                  <p>Total Products Listed</p>
               <h2 id="totalBookings">{{$totalproduct}}</h2>
               </div>
            </div>
            <div class="main-bar-list-item sky-box">
               <div class="left-svg">
               <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
  <g clip-path="url(#clip0_323_1806)">
    <path d="M16.2503 1.0835H4.33366C3.14199 1.0835 2.16699 2.0585 2.16699 3.25016V17.3335C2.16699 17.9293 2.65449 18.4168 3.25033 18.4168C3.84616 18.4168 4.33366 17.9293 4.33366 17.3335V4.3335C4.33366 3.73766 4.82116 3.25016 5.41699 3.25016H16.2503C16.8462 3.25016 17.3337 2.76266 17.3337 2.16683C17.3337 1.571 16.8462 1.0835 16.2503 1.0835ZM16.8895 6.056L22.122 11.2885C22.5228 11.6893 22.7503 12.2418 22.7503 12.816V22.7502C22.7503 23.9418 21.7753 24.9168 20.5837 24.9168H8.65616C7.46449 24.9168 6.50033 23.9418 6.50033 22.7502L6.51116 7.5835C6.51116 6.39183 7.47533 5.41683 8.66699 5.41683H15.3512C15.9253 5.41683 16.4778 5.64433 16.8895 6.056ZM16.2503 13.0002H21.1253L15.167 7.04183V11.9168C15.167 12.5127 15.6545 13.0002 16.2503 13.0002Z" fill="#8CA521"/>
  </g>
  <defs>
    <clipPath id="clip0_323_1806">
      <rect width="26" height="26" fill="white"/>
    </clipPath>
  </defs>
</svg>
               </div>
               <div class="total-booking">
                  <p>Products Listed This Month</p>
                    <h2 id="totalBookings">{{$productsListedThisMonth}}</h2>
               </div>
            </div>
            <div class="main-bar-list-item sky-box">
               <div class="left-svg">
               <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
  <g clip-path="url(#clip0_323_1806)">
    <path d="M16.2503 1.0835H4.33366C3.14199 1.0835 2.16699 2.0585 2.16699 3.25016V17.3335C2.16699 17.9293 2.65449 18.4168 3.25033 18.4168C3.84616 18.4168 4.33366 17.9293 4.33366 17.3335V4.3335C4.33366 3.73766 4.82116 3.25016 5.41699 3.25016H16.2503C16.8462 3.25016 17.3337 2.76266 17.3337 2.16683C17.3337 1.571 16.8462 1.0835 16.2503 1.0835ZM16.8895 6.056L22.122 11.2885C22.5228 11.6893 22.7503 12.2418 22.7503 12.816V22.7502C22.7503 23.9418 21.7753 24.9168 20.5837 24.9168H8.65616C7.46449 24.9168 6.50033 23.9418 6.50033 22.7502L6.51116 7.5835C6.51116 6.39183 7.47533 5.41683 8.66699 5.41683H15.3512C15.9253 5.41683 16.4778 5.64433 16.8895 6.056ZM16.2503 13.0002H21.1253L15.167 7.04183V11.9168C15.167 12.5127 15.6545 13.0002 16.2503 13.0002Z" fill="#8CA521"/>
  </g>
  <defs>
    <clipPath id="clip0_323_1806">
      <rect width="26" height="26" fill="white"/>
    </clipPath>
  </defs>
</svg>
               </div>
               <div class="total-booking">
                  <p>Deals Closed This Month</p>
                   <h2 id="totalBookings">{{$dealsClosedThisMonth}}</h2>
               </div>
            </div>
         </div>
      </section>
      <section class="user-Booking-Statistics">
         <div class="booking-map">
            <div class="left-grid-content">
               <div class="left-grid-pie">
               <div class="pie-graph-upper">
                  <p class="pie-other">Sold</p>
                  <div class="pie-date">
                 <select class="date-selector" name="2024" id="year">
                     @php
        $currentYear = date('Y');
        for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
            echo "<option value=\"$year\">$year</option>";
        }
    @endphp
                  </select>
                  </div>
                </div>
                  <!-- <img src="https://f.motordeals.net/User-images/temp-img.jpg" alt=""> -->
                  <div id="container" style="height: 400px; width: 500px"></div>
               </div>
            </div>
            <div class="right-grid-content">
               <section class="pie-graph">
                <div class="pie-graph-upper">
                  <p class="pie-other">Other Details</p>
                  <div class="pie-date">
                 <select class="date-selector" name="2024" id="pieyear">
                     @php
        $currentYear = date('Y');
        for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
            echo "<option value=\"$year\">$year</option>";
        }
    @endphp
                  </select>
                  </div>
                </div>
                <div class="pie-graph-container">
                  <div class="pieID pie">
                    <div class="center-text-circle">
                  <p>512</p>
                  </div>
                  </div>
                 
                  <ul class="pieID legend">
                     <li>
                        <em>Total number of products</em>
                        <span>718</span>
                     </li>
                     <li>
                        <em>New products listed</em>
                        <span>531</span>
                     </li>
                     <li>
                        <em>Deals Closed</em>
                        <span>868</span>
                     </li>
                  
                  </ul>
                  </div>
               </section>
            </div>
         </div>
      </section>
      <section class="Sales">
         <p class="salex-text">Recently Sold Products</p>
         <div class="main-sections-container">
            <div class="main-section">
               <div class="main-table">
                  <table id="datatable-responsive">
                     <thead>
                        <tr class="heading">
                           <th>Sr No.</th>
                           <th>Listed By</th>
                           <th>Name of Product</th>
                           <th>Category</th>
                           <th>Asking Amount</th>
                           <th>Sold On</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $a=1; ?>
                        @foreach($product as $sales)
                        <tr>
                           <td>##0{{$a}}</td>
                           <td>{{ \App\Models\User::find($sales->user_id)->full_name }}</td>
                           <td>{{ $sales->name}}</td>
                           <td>{{ \App\Models\Category::find($sales->category_id)->name }}</td>
                           <td class="asking-price">${{ $sales->asking_price}}</td>
                           <td>{{ $sales->sold_date}}</td>
                           <td>
                              <div class="button-action">
                                 <a href="{{url('admin/view-product/'.$sales->id)}}">
                                    <button class="edit">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                          <path d="M10.5 5C5.74881 5 2 9.99968 2 9.99968C2 9.99968 5.74881 15 10.5 15C14.133 15 19 9.99968 19 9.99968C19 9.99968 14.133 5 10.5 5ZM10.5 13.1146C8.83148 13.1146 7.47337 11.7172 7.47337 9.99968C7.47337 8.28213 8.83148 6.88411 10.5 6.88411C12.1685 6.88411 13.5266 8.28213 13.5266 9.99968C13.5266 11.7172 12.1685 13.1146 10.5 13.1146ZM10.5 8.18102C10.2652 8.17646 10.0319 8.22012 9.81372 8.30945C9.59553 8.39878 9.39682 8.53199 9.22922 8.70129C9.06162 8.87059 8.92849 9.07258 8.8376 9.29546C8.74672 9.51834 8.69991 9.75763 8.69991 9.99935C8.69991 10.2411 8.74672 10.4804 8.8376 10.7032C8.92849 10.9261 9.06162 11.1281 9.22922 11.2974C9.39682 11.4667 9.59553 11.5999 9.81372 11.6893C10.0319 11.7786 10.2652 11.8222 10.5 11.8177C10.9627 11.8087 11.4035 11.6132 11.7277 11.2731C12.0518 10.9331 12.2334 10.4757 12.2334 9.99935C12.2334 9.52296 12.0518 9.06559 11.7277 8.72557C11.4035 8.38554 10.9627 8.19002 10.5 8.18102Z" fill="#0F8DC2"/>
                                       </svg>
                                    </button>
                                 </a>
                                 <a href="{{url('admin/edit-product/'.$sales->id)}}">
                                    <button class="edit">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                          <path d="M5 13.7086V16H7.29136L14.0493 9.24203L11.758 6.95067L5 13.7086ZM15.8213 7.47005C15.878 7.41352 15.9229 7.34637 15.9536 7.27246C15.9842 7.19854 16 7.1193 16 7.03927C16 6.95925 15.9842 6.88001 15.9536 6.80609C15.9229 6.73217 15.878 6.66503 15.8213 6.6085L14.3915 5.17869C14.335 5.12205 14.2678 5.07711 14.1939 5.04645C14.12 5.01578 14.0408 5 13.9607 5C13.8807 5 13.8015 5.01578 13.7275 5.04645C13.6536 5.07711 13.5865 5.12205 13.53 5.17869L12.4118 6.29687L14.7031 8.58823L15.8213 7.47005Z" fill="#6A810B"/>
                                       </svg>
                                    </button>
                                 </a>
                              </div>
                           </td>
                        </tr>
                        <?php $a++ ?>
                        @endforeach
                     </tbody>
                     <tfooter></tfooter>
                  </table>
               </div>
            </div>
         </div>
      </section>
   </div>
</main>
<script>
   function sliceSize(dataNum, dataTotal) {
   return (dataNum / dataTotal) * 360;
   }
   function addSlice(sliceSize, pieElement, offset, sliceID, color) {
   $(pieElement).append("<div class='slice "+sliceID+"'><span></span></div>");
   var offset = offset - 1;
   var sizeRotation = -179 + sliceSize;
   $("."+sliceID).css({
   "transform": "rotate("+offset+"deg) translate3d(0,0,0)"
   });
   $("."+sliceID+" span").css({
   "transform"       : "rotate("+sizeRotation+"deg) translate3d(0,0,0)",
   "background-color": color
   });
   }
   function iterateSlices(sliceSize, pieElement, offset, dataCount, sliceCount, color) {
   var sliceID = "s"+dataCount+"-"+sliceCount;
   var maxSize = 179;
   if(sliceSize<=maxSize) {
   addSlice(sliceSize, pieElement, offset, sliceID, color);
   } else {
   addSlice(maxSize, pieElement, offset, sliceID, color);
   iterateSlices(sliceSize-maxSize, pieElement, offset+maxSize, dataCount, sliceCount+1, color);
   }
   }
   function createPie(dataElement, pieElement) {
   var listData = [];
   $(dataElement+" span").each(function() {
   listData.push(Number($(this).html()));
   });
   var listTotal = 0;
   for(var i=0; i<listData.length; i++) {
   listTotal += listData[i];
   }
   var offset = 0;
   var color = [
   "#6A810B",    
   "#BED658",      
   "#C5C5C5",   
   // Add more colors if needed
   ];
   for(var i=0; i<listData.length; i++) {
   var size = sliceSize(listData[i], listTotal);
   iterateSlices(size, pieElement, offset, i, 0, color[i]);
   $(dataElement+" li:nth-child("+(i+1)+")").css("border-color", color[i]);
   offset += size;
   }
   }
   createPie(".pieID.legend", ".pieID.pie");
   
</script>

<script>
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            marginBottom: 80
        },
        title: {
            text: '' // Set the chart title
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            labels: {
                rotation: 90
            },
            title: {
                text: '' // Set an empty string to remove the x-axis title
            },
            gridLineWidth: 0 // Remove vertical grid lines
        },
        plotOptions: {
            series: {
                marker: {
                    enabled: false // Disable markers
                },
                color: '#BED658', // Set the line color to green
                lineWidth: 2 // Set the width of the line
            }
        },
        yAxis: {
            gridLineWidth: 0, // Remove horizontal grid lines
            lineWidth: 1, // Set the width of the y-axis line
            lineColor: '#000', // Set the color of the y-axis line
            title: {
                text: '', // Set the heading of the y-axis
            }
        },
        series: [{
            type: 'area', // Use an area series for shadow effect
            data: [],
            fillColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#BED658'], // Start color (yellow) with opacity
                    [1, '#ffffff'] // End color (transparent)
                ]
            },
            zIndex: 0 // Set the z-index to be behind other series
        }]
    });
</script>


<script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Function to initialize the chart
        function initializeChart(year) {
            $.ajax({
                url: 'admin/dchart_revenue',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: { year: year },
                success: function(response) {
                    var months = response.months;
                    var totals = response.totals;


                    var chart = new Highcharts.Chart({
                        chart: {
                            renderTo: 'container',
                            marginBottom: 80
                        },
                        title: {
                            text: '' // Set the chart title
                        },
                        xAxis: {
                            categories: months,
                            labels: {
                                rotation: 90
                            },
                            title: {
                                text: '' // Set an empty string to remove the x-axis title
                            },
                            gridLineWidth: 0 // Remove vertical grid lines
                        },
                        plotOptions: {
                            series: {
                                marker: {
                                    enabled: false
                                },
                                color: '#99AC40',
                                lineWidth: 2
                            }
                        },
                        yAxis: {
                            gridLineWidth: 0,
                            lineWidth: 1,
                            lineColor: '#000',
                            title: {
                                text: '',
                            }
                        },
                        series: [{
                            type: 'area',
                            data: totals,
                            fillColor: {
                                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                stops: [
                                    [0, '#BED658'],
                                    [1, '#ffffff']
                                ]
                            },
                            zIndex: 0
                        }]
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Initialize the chart with the default year
        initializeChart(new Date().getFullYear());

        // Event listener for the change event of the select box
        $('#year').on('change', function() {
            var selectedYear = $(this).val();
            initializeChart(selectedYear); // Initialize the chart with the selected year
        });
    });
</script>



<script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Function to initialize the chart
        function initializeChart(year) {
            $.ajax({
                url: 'admin/dpie_revenue',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: { year: year },
                success: function(response) {
                    var partDealsClosed =  response.partDealsClosed;
                    var totalProductCount = response.totalProductCount;
                    var thisMonthListed = response.thisMonthListed;

                    // Append the values to the HTML elements
                    $('.pieID.pie .center-text-circle p').text(totalProductCount);
                    $('.pieID.legend li:nth-child(1) span').text(totalProductCount);
                    $('.pieID.legend li:nth-child(2) span').text(thisMonthListed);
                    $('.pieID.legend li:nth-child(3) span').text(partDealsClosed);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        // Initialize the chart with the default year
        initializeChart(new Date().getFullYear());

        // Event listener for the change event of the select box
        $('#pieyear').on('change', function() {
            var selectedYear = $(this).val();
            initializeChart(selectedYear); // Initialize the chart with the selected year
        });
    });
</script>
@endsection