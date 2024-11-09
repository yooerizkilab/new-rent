// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
      "order": [[0, "desc"]]  // Urutkan berdasarkan kolom pertama (indeks 0) secara ascending
  });
});

  // Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable1').DataTable();
});