        <section class="content-header">
          <h1>
            <?php
            $Title = preg_replace('/(?<!\ )[A-Z]/', ' $0', $this->fetch('title'));
            echo $Title; ?>
            <!--small>it all starts here</small-->
          </h1>
          <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
          </ol-->
        </section>
