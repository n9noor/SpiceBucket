Hi this is the new enquiry<br />
I am a <?php echo e($enquiry['type']); ?><br />
<br />
Name : <?php echo e($enquiry['name']); ?>

<br />
Phone : <?php echo e($enquiry['phone']); ?>

<br />
Email : <?php echo e($enquiry['email']); ?>

<br />
Address : <?php echo e($enquiry['address']); ?>

<br />
Subject : <?php echo e($enquiry['subject']); ?>

<br />
Message : <?php echo e($enquiry['content']); ?>

<br />
<?php /**PATH /var/www/spicebucket/resources/views/mailtemplate/enquries.blade.php ENDPATH**/ ?>