<style>
    table{
        border-collapse: collapse;
        border: 0.1em solid black;
    }
    td{
        height:20px;
        font-weight: bold;
    }
    .abc td{
            border-left: 0.03em solid black;
            border-right: 0.03em solid black;
            border-bottom: 0.03em solid black;
            border-collapse: collapse;
            border-top: 0.03em solid black;
        }
        b{
            font: bold;
            font-size: 30px;
        }
    
    </style>
    <b style="color:green;">O</b><b>7Services</b><br/>
    <p>Bus Stand, 2nd Floor, Badwal Complex,<br/> Jalandhar, Punjab 144001</p>
<table>
    <tr>
        <th>Name</th>
        <td> {{ $registration->name }}</td>
        <th>RegNo</th>
    <td> O7S/{{ $registration->courses->first()->duration->code}}/{{$registration->id}}</td>
    </tr>
    <tr>
        <th>Email</th>
    <td colspan="2">{{ $registration->email }}</td>
    </tr>
    <tr>
        <th>Contact</th>
    <td colspan="2">{{ $registration->phoneno }}</td>
    </tr>
    <tr>
        <th>Course</th>
        <td>{{ $registration->courses->first()->name }}</td>
        <th>Duration</th>
        <td>{{ $registration->courses->first()->duration->name}}</td>
    </tr>
    <tr>
            <th>Trainer Name</th>
            <td></td>
            <th>Fees</th>
            <td>{{ $registration->total_fees }}</td>
        </tr>
   
</table>
<table class="abc">
    <tr>
        <td>
            Installment No.
        </td>
        <td>
            Fees
        </td>
        <td>
            Date
        </td> 
    </tr>
    <?php 
        $rows = count($registration->fees);
    ?>
    @foreach ($registration->fees as $item)
        <tr>
        <td> {{ $loop->iteration }}</td>
        <td> {{ $item->payable_amount }}</td>
        <td> {{ $item->created_at->format('d-m-Y') }}</td>

        </tr>
    @endforeach
    <?php
    $loop_num = 12 - $rows;
    $num = $loop_num>0 ? $loop_num:0;
        for ($i=0; $i < $num ; $i++) { 
           echo " <tr>
        <td> </td>
        <td> </td>
        <td> </td>

        </tr>";
        }
    ?>
  
</table>
<table>
    <tr style="background-color:yellow;">
        <td>Pending Fees</td>
    <td>{{ $pending_fees}}</td>
        
    </tr>
</table>