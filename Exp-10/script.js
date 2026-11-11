$(function () {
  const $form = $('#book-search');
  const $input = $('#search-input');
  const $button = $('#load-books');
  const $message = $('#message');
  const $list = $('#book-list');
  const $count = $('#book-count');

  $form.on('submit', function (event) {
    event.preventDefault();
    const query = $input.val().trim().toLowerCase();

    $button.prop('disabled', true).text('Loading...');
    $message.removeClass('error').text('Loading books...');
    $list.empty().attr('aria-busy', 'true');
    $count.text('');

    $.ajax({
      url: 'books.json',
      type: 'GET',
      dataType: 'json',
      success: function (books) {
        if (!Array.isArray(books)) {
          $message.addClass('error').text('The book data is not in the expected format.');
          return;
        }

        const results = books.filter(function (book) {
          return `${book.title} ${book.author} ${book.genre || ''} ${book.year || ''}`
            .toLowerCase()
            .includes(query);
        });

        if (!results.length) {
          $message.text(`No books found for “${query}”. Try another title or author.`);
          return;
        }

        $.each(results, function (index, book) {
          const $details = $('<div>').addClass('book-details');
          $('<h3>').addClass('book-title').text(book.title).appendTo($details);
          $('<p>')
            .addClass('book-author')
            .text(`by ${book.author}${book.year ? ` · First published ${book.year}` : ''}`)
            .appendTo($details);
          $('<li>')
            .append($('<span>').addClass('book-number').text(String(index + 1).padStart(2, '0')))
            .append($details)
            .appendTo($list);
        });

        $count.text(`${results.length} ${results.length === 1 ? 'BOOK' : 'BOOKS'}`);
        $message.text(`Showing results for “${query}”.`);
      },
      error: function () {
        $message.addClass('error').text('Could not load books.json. Open this page through a local web server.');
      },
      complete: function () {
        $button.prop('disabled', false).html('<span aria-hidden="true">⌕</span> Load Books');
        $list.attr('aria-busy', 'false');
      }
    });
  });
});
