@if ($message = Session::get('success'))

<div id="successAlert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">

  <strong class="font-bold">{{ $message }}</strong>

  <span id="successCloseBtn" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.357 5.652a.5.5 0 0 0-.707.708L9.293 10l-3.64 3.643a.5.5 0 1 0 .707.707L10 10.707l3.643 3.64a.5.5 0 1 0 .707-.707L10.707 10l3.64-3.643a.5.5 0 0 0 0-.705z"/></svg>
  </span>

</div>

<script>
  document.getElementById('successCloseBtn').addEventListener('click', function() {
    document.getElementById('successAlert').style.display = 'none';
  });
</script>

@endif



@if ($message = Session::get('error'))

<div id="errorAlert" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">

  <strong class="font-bold">{{ $message }}</strong>

  <span id="errorCloseBtn" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.357 5.652a.5.5 0 0 0-.707.708L9.293 10l-3.64 3.643a.5.5 0 1 0 .707.707L10 10.707l3.643 3.64a.5.5 0 1 0 .707-.707L10.707 10l3.64-3.643a.5.5 0 0 0 0-.705z"/></svg>
  </span>

</div>

<script>
  document.getElementById('errorCloseBtn').addEventListener('click', function() {
    document.getElementById('errorAlert').style.display = 'none';
  });
</script>

@endif



@if ($message = Session::get('warning'))

<div id="warningAlert" class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">

  <strong class="font-bold">{{ $message }}</strong>

  <span id="warningCloseBtn" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
    <svg class="fill-current h-6 w-6 text-yellow-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.357 5.652a.5.5 0 0 0-.707.708L9.293 10l-3.64 3.643a.5.5 0 1 0 .707.707L10 10.707l3.643 3.64a.5.5 0 1 0 .707-.707L10.707 10l3.64-3.643a.5.5 0 0 0 0-.705z"/></svg>
  </span>

</div>

<script>
  document.getElementById('warningCloseBtn').addEventListener('click', function() {
    document.getElementById('warningAlert').style.display = 'none';
  });
</script>

@endif



@if ($message = Session::get('info'))

<div id="infoAlert" class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">

  <strong class="font-bold">{{ $message }}</strong>

  <span id="infoCloseBtn" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
    <svg class="fill-current h-6 w-6 text-blue-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.357 5.652a.5.5 0 0 0-.707.708L9.293 10l-3.64 3.643a.5.5 0 1 0 .707.707L10 10.707l3.643 3.64a.5.5 0 1 0 .707-.707L10.707 10l3.64-3.643a.5.5 0 0 0 0-.705z"/></svg>
  </span>

</div>

<script>
  document.getElementById('infoCloseBtn').addEventListener('click', function() {
    document.getElementById('infoAlert').style.display = 'none';
  });
</script>

@endif



