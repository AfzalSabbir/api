      <!-- .app-header -->
      @php
        //Message
        $signedIn = false;
        $has_message = 0;
        $has_notification = 0;
        if (Auth::guard('admin')->check()) {
          $signedIn = true;

          $admin_id = Auth::guard('admin')->user()->id;
          /*
            status = 1: Unread | 2: read
           */
          $has_message = \App\Models\Message::where(['admin_id'=>$admin_id, 'status'=>1, 'message_type'=>2])->get()->count();
          $has_notification = \App\Models\Message::where(['admin_id'=>$admin_id, 'status'=>1, 'message_type'=>3])->get()->count();

        }
      @endphp
      <!-- .app-header -->
      <header class="app-header app-header-dark">
        <!-- .navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-lg-0">
        </nav><!-- /.navbar -->
      </header><!-- /.app-header -->
      <!-- /.app-header -->