

      $(document).ready(function() {


        $('table').DataTable();
            
         $('#myTab a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
      })    
    
            function checkSessionRole() {
                if (roles !== "Admin") {
                    $(".roles").addClass("hidden").remove('roles');
                }
            }
        
            // Call the function when the document is ready
            checkSessionRole();
    //   chart
    function fetchData() {
        $.ajax({
            url: 'api/chart.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                updateChart(response);
            },
            error: function(xhr, status, error) {
                console.error('XHR request failed with status:', xhr.status);
            }
        });
    }
    
    // Function to update chart
    function updateChart(response) {
        // Aggregate data by order date and status
        var aggregatedData = {};
        response.forEach(function(order) {
            var orderDate = order.order_date;
            var status = order.statu.toLowerCase();
    
            if (!aggregatedData[orderDate]) {
                aggregatedData[orderDate] = { finished: 0, pending: 0 };
            }
    
            if (status === 'finished') {
                aggregatedData[orderDate].finished++;
            } else if (status === 'pending') {
                aggregatedData[orderDate].pending++;
            }
        });
    
        // Convert aggregatedData into an array of objects
        var chartData = [];
        Object.keys(aggregatedData).forEach(function(date) {
            chartData.push({
                x: date,
                finished: aggregatedData[date].finished,
                pending: aggregatedData[date].pending
            });
        });
    
        // Sort chartData by date
        chartData.sort(function(a, b) {
            return new Date(a.x) - new Date(b.x);
        });
    
        // Chart options
        var options = {
            series: [{
                name: 'Finished',
                data: chartData.map(item => item.finished)
            }, {
                name: 'Pending',
                data: chartData.map(item => item.pending)
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            xaxis: {
                categories: chartData.map(item => item.x),
                labels: {
                    rotate: -45,
                    formatter: function(val) {
                        return val; // You can format the date as needed
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Number of Orders'
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                offsetX: 40
            }
        };
    
        // Render chart
        var chart = new ApexCharts(document.querySelector("#myChart"), options);
        chart.render();
    }
    
    // Initial chart rendering
    fetchData();
     
    // end of orders chart
        $.ajax({
            url: 'api/oview.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {

                var today = new Date();
                today.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0 for accurate comparison
    
                // Filter orders for today
                var ordersForToday = response.filter(function(order) {
                    // Convert order_date to a Date object
                    var orderDateParts = order.order_date.split('/');
                    var orderDate = new Date(orderDateParts[2], orderDateParts[0] - 1, orderDateParts[1]); // Month is 0-based in JavaScript Date constructor
                    orderDate.setHours(0, 0, 0, 0); // Set hours, minutes, seconds, and milliseconds to 0 for accurate comparison
                    return orderDate.getTime() === today.getTime(); // Compare the dates
                });
    
                // If there are orders for today, proceed to calculate and display results
                if (ordersForToday.length > 0) {
                    // Calculate sum of deposited_price for orders on today
                    var sumDepositedPrice = ordersForToday.reduce(function(acc, order) {
                        return acc + parseFloat(order.deposited_price);
                    }, 0);
    
                    // Display sum of deposited_price
                    $('#totalearning').text('Ugx ' + sumDepositedPrice.toFixed(0));
                    sessionStorage.setItem("earned",sumDepositedPrice.toFixed(0) );
                    // Update the number of orders for today
                    var numberOfOrders = ordersForToday.length;
                    $('#numberOrders').text(numberOfOrders);
                } else {
                    // If there are no orders for today, display appropriate message or hide elements
                    $('#totalearning').text('No orders for today');
                    $('#numberOrders').text('0');
                }
            },
         
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    
        //  $('#pendingOrders').text(pendingOrders.length);
                // $('#finishedOrders').text(finishedOrders.length);
    
    
    
        // end for order veiw
        $('#orderForm').submit(function(event) {
            event.preventDefault();

            var upperBodyMeasurements = {
                shoulderLength: $('#shoulderLength').val(),
                bust: $('#bust').val(),
                waist: $('#waist').val(),
                shirtLength: $('#shirtLength').val(),
                waistcoatLength: $('#waistcoatLength').val(),
                jacketLength: $('#jacketLength').val(),
                sleeveLengthLong: $('#sleeveLengthLong').val(),
                sleeveLengthShort: $('#sleeveLengthShort').val(),
                bicep: $('#bicep').val(),
                back: $('#back').val(),
                front: $('#front').val(),
                uother: $('#uother').val()
            };
    
            var lowerBodyMeasurements = {
                waist: $('#waistLower').val(),
                hips: $('#hips').val(),
                thighs: $('#thighs').val(),
                calf: $('#calf').val(),
                bottomOfTrousers: $('#bottomOfTrousers').val(),
                trouserLength: $('#trouserLength').val(),
                fly: $('#fly').val(),
                inseam: $('#inseam').val(),
                lother: $('#lother').val()
            };
    
            var Measurements = {
                
                upperBody: upperBodyMeasurements,
                lowerBody: lowerBodyMeasurements
            };
     
          // Get the current date
var currentDate = new Date();

// Get the components of the date
var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 because getMonth() returns zero-based month
var day = currentDate.getDate().toString().padStart(2, '0');
var year = currentDate.getFullYear();

// Construct the date string in "mm/dd/yyyy" format
var formattedDate = month + '/' + day + '/' + year;
            console.log(formattedDate)
            var formData = {
                name: $('#name').val(),
                email: $('#email').val(),
                tel: $('#tel').val(),
                details: $('#details').val(),
                tailor: $('#tailor').val(),
                measure: Measurements,
                status: $('#Select').val(),
                orderdate: formattedDate,
                deliverdate: $('#deliverdate').val(),
                depositedprice: $('#depostedprice').val(),
                price: $('#price').val()
            };
            
            var missingFields = [];
            for (var key in formData) {
                // Skip the email field
                if (key === 'email') {
                    continue;
                }
                if (!formData[key]) {
                    missingFields.push(key);
                }
            }
            
            if (missingFields.length > 0) {
                var missingFieldsText = missingFields.join(', ');
                $('#errorAlert').show().text('Please fill in the following fields: ' + missingFieldsText);
                return;
            }
            formData.measure = JSON.stringify(Measurements);
           
            $.ajax({
                type: 'POST',
                url: 'api/order.php', 
                data: formData,
                dataType: 'json',
                encode: true
            }) 
            .done(function(response) {
                if (response.success) {
                    $('#orderForm')[0].reset(); 
                    $('#successAlert').show().text(response.message);
                    $('#notifi').show();
                    setTimeout(function() {
                        $('#notifi').slideUp(); 
                    }, 5000); 
                } else {
                    $('#errorAlert').show().text(response.message);
                    $('#notifi').show();
                    setTimeout(function() {
                        $('#notifi').slideUp(); 
                    }, 5000);
                }
            })
            .fail(function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#errorAlert').show().text('An error occurred while processing your request.');
            });
        });
    
    // order update
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');
    
    // Check if 'success' parameter exists and show Bootstrap alert accordingly
    if (success !== null) {
        const message = success === 'true' ? 'Order updated successfully' : 'Error updating order';
        const alertType = success === 'true' ? 'success' : 'danger';
    
        // Display Bootstrap alert in the 'notifi' div
        const alertDiv = $('<div class="alert alert-' + alertType + ' alert-dismissible fade show" role="alert">' +
                            '<strong>' + message + '</strong>' +'</div>');
    
        // Append alert to the 'notifi' div and fade out after 3 seconds
        $('#notifi').append(alertDiv);
        setTimeout(function(){
            alertDiv.fadeOut();
        }, 3000);
    }
    
// achieve adding
    $('#achieveForm').submit(function(event) {
        event.preventDefault();

        var upperBodyMeasurements = {
            shoulderLength: $('#shoulderLength').val(),
            bust: $('#bust').val(),
            waist: $('#waist').val(),
            shirtLength: $('#shirtLength').val(),
            waistcoatLength: $('#waistcoatLength').val(),
            jacketLength: $('#jacketLength').val(),
            sleeveLengthLong: $('#sleeveLengthLong').val(),
            sleeveLengthShort: $('#sleeveLengthShort').val(),
            bicep: $('#bicep').val(),
            back: $('#back').val(),
            front: $('#front').val(),
            uother: $('#uother').val()
        };

        var lowerBodyMeasurements = {
            waist: $('#waistLower').val(),
            hips: $('#hips').val(),
            thighs: $('#thighs').val(),
            calf: $('#calf').val(),
            bottomOfTrousers: $('#bottomOfTrousers').val(),
            trouserLength: $('#trouserLength').val(),
            fly: $('#fly').val(),
            inseam: $('#inseam').val(),
            lother: $('#lother').val()
        };

        var Measurements = {
            
            upperBody: upperBodyMeasurements,
            lowerBody: lowerBodyMeasurements
        };
 
      // Get the current date
var currentDate = new Date();

// Get the components of the date
var month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 because getMonth() returns zero-based month
var day = currentDate.getDate().toString().padStart(2, '0');
var year = currentDate.getFullYear();

// Construct the date string in "mm/dd/yyyy" format
var formattedDate = month + '/' + day + '/' + year;
        console.log(formattedDate)
        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            tel: $('#tel').val(),
            details: $('#details').val(),
            tailor: $('#tailor').val(),
            measure: Measurements,
            status: $('#Select').val(),
            orderdate: formattedDate,
            deliverdate: $('#deliverdate').val(),
            depositedprice: $('#depostedprice').val(),
            price: $('#price').val()
        };
        
        var missingFields = [];
        for (var key in formData) {
            // Skip the email field
            if (key === 'email') {
                continue;
            }
            if (!formData[key]) {
                missingFields.push(key);
            }
        }
        
        if (missingFields.length > 0) {
            var missingFieldsText = missingFields.join(', ');
            $('#errorAlert').show().text('Please fill in the following fields: ' + missingFieldsText);
            return;
        }
        formData.measure = JSON.stringify(Measurements);
       
        $.ajax({
            type: 'POST',
            url: 'api/achieves.php', 
            data: formData,
            dataType: 'json',
            encode: true
        }) 
        .done(function(response) {
            if (response.success) {
                $('#achieveForm')[0].reset(); 
                $('#successAlert').show().text(response.message);
                $('#notifi').show();
                setTimeout(function() {
                    $('#notifi').slideUp(); 
                }, 5000); 
            } else {
                $('#errorAlert').show().text(response.message);
                $('#notifi').show();
                setTimeout(function() {
                    $('#notifi').slideUp(); 
                }, 5000);
            }
        })
        .fail(function(xhr, status, error) {
            console.error(xhr.responseText);
            $('#errorAlert').show().text('An error occurred while processing your request.');
        });
    });
    
    
    // user adding and updating
    $('#registrationForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
    
        // Collect form data
        var formData = {
            userName: $('#userName').val(),
            email: $('#email').val(),
            role: $('#role').val(),
            password: $('#password').val(),
            confirmPassword: $('#confirmPassword').val(),
            passwordHint: $('#passwordHint').val()
        };
    
        // Client-side validation
        if (formData.password !== formData.confirmPassword) {
            $('#errorAlert').show().text('Passwords do not match.');
            $('#notifi').show();
            setTimeout(function() {
                $('#notifi').slideUp(); 
            }, 5000);
            return;
        }
    
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: 'api/user.php', 
            data: formData,
            dataType: 'json',
            encode: true
        })
        .done(function(response) {
            if (response.success) {
                $('#registrationForm')[0].reset(); 
                $('#successAlert').show().text(response.message);
                $('#notifi').show();
                setTimeout(function() {
                    $('#notifi').slideUp(); 
                }, 5000);
    
            } else {
                $('#errorAlert').show().text(response.message);
                $('#notifi').show();
                setTimeout(function() {
                    $('#notifi').slideUp(); 
                }, 5000);
    
            }
        })
        .fail(function(xhr, status, error) {
            console.error(xhr.responseText);
            $('#errorAlert').show().text('An error occurred while processing your request.');
        });
    });
    
    
    });
    
    
    // expenditure
    $(document).ready(function () {
        // AJAX for adding expenditure
        $('#expenditureForm').submit(function (e) {
        
            $.ajax({
                type: 'POST',
                url: 'api/expend.php',
                data: $(this).serialize(),
                success: function (response) {
                    $('#expenditureForm')[0].reset(); // Reset form fields
                    showAlert('success', 'Expenditure added successfully.');
                },
                error: function (xhr, status, error) {
                    showAlert('danger', 'Error adding expenditure: ' + error);
                }
            });
        });
       
    
        // Clear button functionality
        $('#clearButton').click(function () {
            $('#expenditureForm')[0].reset(); // Reset form fields
        });
    
       
    
        // Function to display alerts
        function showAlert(type, message) {
            $('#notifi').html(
                '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                message +
                '</div>'
            );
        }
    });
    
    $('#tailor').select2({
        placeholder: "Select a tailor",
        allowClear: true
      });


// AJAX for adding expenditure
$('#tailorForm').submit(function(event) {
    event.preventDefault(); // Prevent default form submission
  
    const formData = $(this).serialize();
    const apiUrl = 'api/tailor.php';
  
    $.ajax({
      type: 'POST',
      url: apiUrl,
      data: formData,
      success: (response) => {
        $('#tailorForm')[0].reset(); 
        showAlert('success', 'Tailor added successfully.');
        
      },
      error: (xhr, status, error) => {
        showAlert('danger', `Error adding tailor: ${error}`);
       
      }
    });
  });




    function togglePriceInputs() {
        var selectElement = $('#Select');
        var depositedPriceInput = $('#depositedprice');
        var totalPriceInput = $('#price');
    
        if (selectElement.value === "Finished") {
            depositedPriceInput.disabled = true;
            totalPriceInput.disabled = true;
        } else {
            depositedPriceInput.disabled = false;
            totalPriceInput.disabled = false;
        }
    }