<script src="{{ asset('admin/plugins/common/common.min.js') }}"></script>
<script src="{{ asset('admin/js/custom.min.js') }}"></script>
<script src="{{ asset('admin/js/settings.js') }}"></script>
<script src="{{ asset('admin/js/gleek.js') }}"></script>
<script src="{{ asset('admin/js/styleSwitcher.js') }}"></script>

<!-- Chartjs -->
<script src="{{ asset('admin/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Circle progress -->
<script src="{{ asset('admin/plugins/circle-progress/circle-progress.min.js') }}"></script>
<!-- Datamap -->
<script src="{{ asset('admin/plugins/d3v3/index.js') }}"></script>
<script src="{{ asset('admin/plugins/topojson/topojson.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datamaps/datamaps.world.min.js') }}"></script>
<!-- Morrisjs -->
<script src="{{ asset('admin/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/plugins/morris/morris.min.js') }}"></script>
<!-- Pignose Calender -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pg-calendar/js/pignose.calendar.min.js') }}"></script>
<!-- ChartistJS -->
<script src="{{ asset('admin/plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ asset('admin/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js') }}"></script>



<script src="{{ asset('admin/js/dashboard/dashboard-1.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($message = Session::get('succes')){
<script>
Swal.fire({
    title: "INFO",
    text: "{{ $message }}",
    icon: "success"
});
</script>
}
@endif
@if($message = Session::get('failed')){
<script>
Swal.fire({
    title: "INFO",
    text: "{{ $message }}",
    icon: "error"
});
</script>
}
@endif