@includeWhen(auth()->check() && auth()->user()->confirmed, 'modals.new-thread')
