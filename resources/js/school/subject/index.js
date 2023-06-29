let $btnEdit = $('#btn-edit'),
    $yearLevel = $(`[name='year_level_id']`),
    $name = $(`[name='name']`),
    $document = $(document),
    $subject = $('#subject');

$document.on('click', '#btn-edit', function() {
  const data = $(this).closest('tr');
  const subjectId = data.find('td')[0].textContent;
  const subjectName = data.find('td')[1].textContent;
  const yearLevel = data.find('td')[2].textContent;
  $name.val(subjectName);
  $yearLevel.each(function () {
    $('option', this).each(function () {
      if ($(this).text() == yearLevel) {
          $(this).attr('selected', 'selected')
      };
    });
  });
  $subject.attr('action', `/subject/${subjectId}`);
  $subject.append(`<input type='hidden' name='_method' value='PATCH' />`);
});
