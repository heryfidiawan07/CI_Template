$(document).ready(function() {

    var base_url = $('#base_url').val();

    // Chart ======================================================================================================


    // TID BY TRUCK =========================================================================
    const types = document.querySelectorAll('.types');
    var jenis   = [];
    var counts  = [];
    var colors  = [];
    // var borders = [];
    types.forEach(function(type) {
        jenis.push(type.getAttribute('data-type'));
        counts.push(type.getAttribute('data-count'));
        colors.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', 0.'+5+type.getAttribute('data-count')+')');
        // borders.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+type.getAttribute('data-count')+')');
    });

    var cavasStidTruck = document.getElementById('stid').getContext('2d');
    var stidTruck = new Chart(cavasStidTruck, {
        type: 'bar',
        data: {
            labels: jenis,
            datasets: [{
                label: '#TID',
                data: counts,
                backgroundColor: colors,
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Update Chart Truck TID
    $('#company').on('change', function() {
        var company_id = $('#company').val();
        var tidByCompanyUrl = base_url+'dashboard/tidTruckByCompany/'+company_id;
        $.ajax({
            url: tidByCompanyUrl,
            method: 'GET',
            success: function(data){
                var types  = JSON.parse(data);
                var jenis  = [];
                var counts = [];
                var colors = [];
                // console.log(types);
                types.forEach(function(type) {
                    jenis.push(type.name);
                    counts.push(type.count);
                    colors.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', 0.'+5+type.count+')');
                    // borders.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+type.getAttribute('data-count')+')');
                });
                stidTruck.data.labels = jenis;
                stidTruck.data.datasets[0].data = counts;
                stidTruck.data.datasets[0].backgroundColor = colors;
                stidTruck.update();
            }
        });
    });


    // TRUCK BY COMPANY ===========================================================================================================
    const trucks = document.querySelectorAll('.trucks');
    var company  = [];
    var vehicle  = [];
    var colors   = [];

    trucks.forEach(function(truck) {
        company.push(truck.getAttribute('data-truck'));
        vehicle.push(truck.getAttribute('data-countTruck'));
        colors.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', 0.'+7+truck.getAttribute('data-countTruck')+')');
    });

    var cavasTruck = document.getElementById('truck').getContext('2d');
    var truckChart = new Chart(cavasTruck, {
        type: 'pie', //doughnut //polarArea
        data: {
            // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            labels: company,
            datasets: [{
                // data: [12, 19, 3, 5, 2, 3],
                data: vehicle,
                backgroundColor: colors,
            }]
        }
    });


    // TID BY PERIODE =============================================================================================================
    const stid = document.querySelectorAll('.stid');
    var month  = [];
    var counts = [];
    var colors = [];
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    // var borders = [];
    stid.forEach(function(tid) {
        month.push(months[tid.getAttribute('data-month')-1]);
        counts.push(tid.getAttribute('data-count'));
        colors.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', 0.'+3+tid.getAttribute('data-count')+')');
        // borders.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+tid.getAttribute('data-count')+')');
    });

    var cavasStid = document.getElementById('periode').getContext('2d');
    var stidPeriode = new Chart(cavasStid, {
        type: 'line',
        data: {
            labels: month,
            datasets: [{
                label: '#TID',
                data: counts,
                backgroundColor: colors,
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });

    // Update Chart Periode
    var date = new Date();
    $('#year option[value='+date.getFullYear()+']').attr('selected','selected');
    $('#year').on('change', function() {
        var year = $('#year').val();
        var periodUrl = base_url+'dashboard/tidByPeriode/'+year;
        $.ajax({
            url: periodUrl,
            method: 'GET',
            success: function(data){
                var data   = JSON.parse(data);
                var month  = [];
                var counts = [];
                var colors = [];
                var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
                data.forEach(function(dt) {
                    month.push(months[dt.month-1]);
                    counts.push(dt.count);
                    colors.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', 0.'+3+dt.count+')');
                });
                stidPeriode.data.labels = month;
                stidPeriode.data.datasets[0].data = counts;
                stidPeriode.data.datasets[0].backgroundColor = colors;
                stidPeriode.update();
            }
        });
    });


    // TID BY Renewal =============================================================================================================
    const renewal = document.querySelectorAll('.renewal');
    var month  = [];
    var counts = [];
    var colors = [];
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    // var borders = [];
    renewal.forEach(function(tid) {
        month.push(months[tid.getAttribute('data-month')-1]);
        counts.push(tid.getAttribute('data-count'));
        colors.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', 0.'+3+tid.getAttribute('data-count')+')');
        // borders.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+tid.getAttribute('data-count')+')');
    });

    var cavasStid = document.getElementById('renewal').getContext('2d');
    var stidPeriode = new Chart(cavasStid, {
        type: 'line',
        data: {
            labels: month,
            datasets: [{
                label: '#TID',
                data: counts,
                backgroundColor: colors,
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });

    // Update Chart Renewal
    var date = new Date();
    $('#renewal_year option[value='+date.getFullYear()+']').attr('selected','selected');
    $('#renewal_year').on('change', function() {
        var year = $('#renewal_year').val();
        var renewalUrl = base_url+'dashboard/tidByRenewal/'+year;
        $.ajax({
            url: renewalUrl,
            method: 'GET',
            success: function(data){
                var data   = JSON.parse(data);
                var month  = [];
                var counts = [];
                var colors = [];
                var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
                data.forEach(function(dt) {
                    month.push(months[dt.month-1]);
                    counts.push(dt.count);
                    colors.push('rgba('+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', '+Math.floor(Math.random() * 255)+', 0.'+3+dt.count+')');
                });
                stidPeriode.data.labels = month;
                stidPeriode.data.datasets[0].data = counts;
                stidPeriode.data.datasets[0].backgroundColor = colors;
                stidPeriode.update();
            }
        });
    });

});