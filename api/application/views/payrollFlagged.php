<html>
    <head></head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="2"><?php echo "Name: ". $emp; ?></th>
                </tr>
                <tr>
                    <th colspan="2"><?php echo "Flagged By: ". $name; ?></th>
                </tr>
                <tr>
                    <th>Date</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $check = true;
                foreach($details as $shift){ ?>
                <tr>
                    <td><?php  echo date('d M Y',strtotime($shift->shiftDate)); ?></td>
                    <?php if($check){ ?>
                    <td rowspan="<?php echo count($details); ?>"><?php echo $shift->message; $check = false; ?></td>
                    <?php 
                        } 
                    ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>