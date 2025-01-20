    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Student Details</title>
        <style>
            :root {
                --primary-color:hsl(270, 46.20%, 28.40%);
                --primary-hover:hsl(270, 46.20%, 48.40%);
                --background: #f8fafc;
                --card-background: #ffffff;
                --text-color: #1f2937;
                --border-color: #e5e7eb;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                background: var(--background);
                color: var(--text-color);
                margin: 0;
                min-height: 100vh;
                place-items: center;
            }

            .form-container {
                background: var(--card-background);
                padding: 1.5rem;
                border-radius: 0.75rem;
                box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
                width: 100%;
                max-width: 600px;
                margin-top:5%;
            }

            .title {
                font-size: 1.5rem;
                font-weight: 600;
                margin: 0 0 1.5rem;
                text-align: center;
                color: var(--text-color);
            }

            .row {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
                margin-bottom: 1rem;
            }

            .full-width {
                grid-column: 1 / -1;
            }

            .field {
                display: flex;
                flex-direction: column;
                gap: 0.25rem;
            }

            label {
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--text-color);
            }

            input, select {
                padding: 0.5rem;
                border: 1px solid var(--border-color);
                border-radius: 0.375rem;
                font-size: 0.875rem;
                transition: border-color 0.15s ease;
            }

            input:focus, select:focus {
                outline: none;
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            }

            button {
                background: var(--primary-color);
                color: white;
                border: none;
                padding: 0.625rem;
                border-radius: 0.375rem;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.15s ease;
                width: 100%;
            }

            button:hover {
                background: var(--primary-hover);
            }

            @media (max-width: 640px) {
                .row {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <div class="form-container">
            <h2 class="title">Edit Student Information</h2>
            <?php if ($this->session->flashdata('success')): ?>
            <div style="padding: 1rem; background-color: #d4edda; color: #155724; margin-bottom: 1rem; border: 1px solid #c3e6cb; border-radius: 0.25rem;">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div style="padding: 1rem; background-color: #f8d7da; color: #721c24; margin-bottom: 1rem; border: 1px solid #f5c6cb; border-radius: 0.25rem;">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?php echo base_url('admin_dashboard/edit_student_details/' . $student->id); ?>" method="POST">
                <!-- ID and Name -->
                <div class="row">
                    <div class="field">
                        <label for="id">Student ID</label>
                        <input type="text" id="id" name="id" value="<?php echo $student->id; ?>" readonly>
                    </div>
                    <div class="field">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $student->name; ?>" required>
                    </div>
                </div>

                <!-- Email and Phone -->
                <div class="row">
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $student->email; ?>" required>
                    </div>
                    <div class="field">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo $student->phone; ?>" required>
                    </div>
                </div>

                <!-- College (Full Width) -->
                <div class="field" style="margin-bottom: 1rem;">
                    <label for="college">College</label>
                    <select id="college" name="college" required>
                        <?php
                        $query = $this->db->query("SHOW COLUMNS FROM student_info LIKE 'college'");
                        $row = $query->row();
                        preg_match_all("/'([^']+)'/", $row->Type, $enumValues);
                        foreach ($enumValues[1] as $value) {
                            $selected = ($student->college == $value) ? 'selected' : '';
                            echo "<option value='$value' $selected>$value</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Campus (Full Width) -->
                <div class="field" style="margin-bottom: 1rem;">
                    <label for="campus">Campus</label>
                    <select id="campus" name="campus" required>
                        <?php
                        $query = $this->db->query("SHOW COLUMNS FROM student_info LIKE 'campus'");
                        $row = $query->row();
                        preg_match_all("/'([^']+)'/", $row->Type, $enumValues);
                        foreach ($enumValues[1] as $value) {
                            $selected = ($student->campus == $value) ? 'selected' : '';
                            echo "<option value='$value' $selected>$value</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Mess (Full Width) -->
                <div class="field" style="margin-bottom: 1.5rem;">
                    <label for="mess">Mess Preference</label>
                    <select id="mess" name="mess" required>
                        <?php
                        $query = $this->db->query("SHOW COLUMNS FROM student_info LIKE 'mess'");
                        $row = $query->row();
                        preg_match_all("/'([^']+)'/", $row->Type, $enumValues);
                        foreach ($enumValues[1] as $value) {
                            $selected = ($student->mess == $value) ? 'selected' : '';
                            echo "<option value='$value' $selected>$value</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit">Update Information</button>
            </form>
        </div>
    </body>
    </html>