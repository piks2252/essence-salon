<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		body{
		  font-family: Arial, Helvetica, sans-serif;
		}
		table {
		  border-collapse: collapse;
		  width: 100%;
		}

		table td, table th {
		  border: 1px solid #ddd;
		  padding: 8px;
		}

		table tr:nth-child(even){background-color: #f2f2f2;}

		table tr:hover {background-color: #ddd;}

		table th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: rgb(27, 125, 88);
		  color: #fff;
		  text-align: center;
		}
	</style>
</head>
<body>
	<div style="width:100%">
		<div style="padding-bottom: 20px">
			<div style="width:40%; display: inline-block;">
				<img src="file:///home/pratik/Documents/projects/laravel/cupoflove/public/assets/images/logo/logo-text.png" style="width:200px" />
			</div>
			<div style="width:50%;display: inline-block;text-align: right;">
				<h1 style="color:#6f6666;margin: 2px 0;font-size: 25px">QUOTATION</h1>
				<span style="font-size: 12px">Date: {{ date('d/m/Y') }} </span>
			</div>
		</div>
		<div style="margin: 20px 0">
			<div style="text-align: left;display: inline-block; width: 25%; vertical-align: top;">
				<p style="margin: 5px 0; font-size: 12px;vertical-align: text-top:">Quoted To:</p>
				<p style="border-bottom: 1px solid; margin:5px 0; display: inline-block;font-weight: 700">{{$quotation["name"]}}</p>
				<p style="margin: 5px 0; font-size: 12px;white-space: pre;">{{ $quotation["address"] }}</p>
			</div>
			<div style="text-align: center;display: inline-block;width: 44%">
				<!-- <img src="file:///home/pratik/Documents/projects/laravel/cupoflove/public/assets/images/logo/logo-hor.png" style="width:200px" /> -->
			</div>
			<div style="text-align: justify;display: inline-block;width: 26%;">
					<p style="margin: 5px 0; font-size: 12px;">Quoted From:</p>
					<p style="margin: 5px 0;"><span style="border-bottom: 1px solid;font-weight: 700">Neon Lights</span></p>
					<p style="margin: 5px 0; font-size: 12px;clear: both;">F-6, Dev Aditya Arcade <br> Thalteh-Shilaj Road <br> Ahmedabad - 380059</p>
					<p style="margin: 5px 0; font-size: 12px;">Phone: +91 7698923527</p>
					<p style="margin: 5px 0; font-size: 12px;">Mail: neonlights0003@gmail.com</p>
					<p style="margin: 5px 0; font-size: 12px;color:blue;">Web: neonlighthouse.in</p>
			</div>
		</div>
		<div>
			<div style="width:50%"></div>
			<div style="width:50%"></div>
		</div>
		<div>
			<table style="width:100%">
				<thead>
					<tr>
                        <th>SN</th>
                        <th>Product</th>
                        <th>Color</th>
                        <th>Watt</th>
                        <th>Nos</th>
                        <th>Unit</th>
                        <th>Rate</th>
                        <th>Amount</th>
                      </tr>
				</thead>
				<tbody style="text-align: center;">
					@foreach ($quotation["products"] as $key => $product)  

					<tr>
						<td>{{$key+1}}</td>
                        <td>{{ $product["name"] }}</td>
                        <td>{{ $product["color"] }}</td>
                        <td>{{ $product["watt"] }}</td>
                        <td>{{ $product["nos"] }}</td>
                        <td>{{ $product["unit"] }}</td>
                        <td>{{$product["rate"] }}</td>
                        <td>{{ $product["amount"] }}</td>
					</tr>
					@endforeach
					<tr>
                        <td colspan="7" style="text-align: right">
                            Discount
                        </td>
                        <td>
                            {{ $quotation["discount"] }}%
                        </td>
                    </tr>        
                    <tr>
                        <td colspan="7" style="text-align: right">
                            Total
                        </td>
                        <td>
                            {{ $quotation["total"] }}
                        </td>
                    </tr>        
				</tbody>
			</table>
		</div>
		<div>
			<p style="display: inline-block;border-bottom: 1px solid">Note</p>
			<ol>
				<li>All products have 2 year warranty</li>
				<li>GST will be extra applicable</li>
			</ol>
		</div>
		<div>
			<p style="text-align: center;">If you have any questions concerning this quote, contact: Sarthak Patel at +917698923527 or neonlights0003@gmail.com</p>
		</div>
		<div>
			<h1 style="text-align: center; color:#6f6666">Thank You For Your Business</h1>
		</div>
	</div>
</body>
</html>