<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This migration adds ALL foreign key constraints at the end
     * after all tables have been created.
     */
    public function up(): void
    {
        // Foreign keys for rekapitulasi table
        Schema::table('rekapitulasi', function (Blueprint $table) {
            $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });

        // Foreign keys for kategori_kerusakan table
        if (Schema::hasTable('kategori_kerusakan')) {
            Schema::table('kategori_kerusakan', function (Blueprint $table) {
                if (Schema::hasColumn('kategori_kerusakan', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for detail_kerusakan table
        if (Schema::hasTable('detail_kerusakan')) {
            Schema::table('detail_kerusakan', function (Blueprint $table) {
                if (Schema::hasColumn('detail_kerusakan', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
                if (Schema::hasColumn('detail_kerusakan', 'kategori_kerusakan_id')) {
                    $table->foreign('kategori_kerusakan_id')->references('id')->on('kategori_kerusakan')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for form_perumahan table
        // if (Schema::hasTable('form_perumahan')) {
        //     Schema::table('form_perumahan', function (Blueprint $table) {
        //         if (Schema::hasColumn('form_perumahan', 'bencana_id')) {
        //             $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        //         }
        //     });
        // }

        // Foreign keys for kerugian table
        // if (Schema::hasTable('kerugian')) {
        //     Schema::table('kerugian', function (Blueprint $table) {
        //         if (Schema::hasColumn('kerugian', 'bencana_id')) {
        //             $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        //         }
        //     });
        // }

        // Foreign keys for wilayah_bencana table
        if (Schema::hasTable('wilayah_bencana')) {
            Schema::table('wilayah_bencana', function (Blueprint $table) {
                if (Schema::hasColumn('wilayah_bencana', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for education_reports table
        if (Schema::hasTable('education_reports')) {
            Schema::table('education_reports', function (Blueprint $table) {
                if (Schema::hasColumn('education_reports', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for health_reports table
        if (Schema::hasTable('health_reports')) {
            Schema::table('health_reports', function (Blueprint $table) {
                if (Schema::hasColumn('health_reports', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for government_reports table
        if (Schema::hasTable('government_reports')) {
            Schema::table('government_reports', function (Blueprint $table) {
                if (Schema::hasColumn('government_reports', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for transportation_reports table
        if (Schema::hasTable('transportation_reports')) {
            Schema::table('transportation_reports', function (Blueprint $table) {
                if (Schema::hasColumn('transportation_reports', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for environmental_reports table
        if (Schema::hasTable('environmental_reports')) {
            Schema::table('environmental_reports', function (Blueprint $table) {
                if (Schema::hasColumn('environmental_reports', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for form1 table
        // if (Schema::hasTable('form1')) {
        //     Schema::table('form1', function (Blueprint $table) {
        //         if (Schema::hasColumn('form1', 'bencana_id')) {
        //             $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
        //         }
        //     });
        // }

        // Foreign keys for keputusan table
        if (Schema::hasTable('keputusan')) {
            Schema::table('keputusan', function (Blueprint $table) {
                if (Schema::hasColumn('keputusan', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for pendataan table
        if (Schema::hasTable('pendataan')) {
            Schema::table('pendataan', function (Blueprint $table) {
                if (Schema::hasColumn('pendataan', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for rumahtangga table
        if (Schema::hasTable('rumahtangga')) {
            Schema::table('rumahtangga', function (Blueprint $table) {
                if (Schema::hasColumn('rumahtangga', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for fgd table
        if (Schema::hasTable('fgd')) {
            Schema::table('fgd', function (Blueprint $table) {
                if (Schema::hasColumn('fgd', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for form9 table
        if (Schema::hasTable('form9')) {
            Schema::table('form9', function (Blueprint $table) {
                if (Schema::hasColumn('form9', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for analisa table
        if (Schema::hasTable('analisa')) {
            Schema::table('analisa', function (Blueprint $table) {
                if (Schema::hasColumn('analisa', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for anggaran table
        if (Schema::hasTable('anggaran')) {
            Schema::table('anggaran', function (Blueprint $table) {
                if (Schema::hasColumn('anggaran', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for form_data table
        if (Schema::hasTable('form_data')) {
            Schema::table('form_data', function (Blueprint $table) {
                if (Schema::hasColumn('form_data', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for format1_form4s table
        if (Schema::hasTable('format1_form4s')) {
            Schema::table('format1_form4s', function (Blueprint $table) {
                if (Schema::hasColumn('format1_form4s', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for format5_form4s table
        if (Schema::hasTable('format5_form4s')) {
            Schema::table('format5_form4s', function (Blueprint $table) {
                if (Schema::hasColumn('format5_form4s', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for format6_form4s table
        if (Schema::hasTable('format6_form4s')) {
            Schema::table('format6_form4s', function (Blueprint $table) {
                if (Schema::hasColumn('format6_form4s', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for format7_form4s table
        if (Schema::hasTable('format7_form4s')) {
            Schema::table('format7_form4s', function (Blueprint $table) {
                if (Schema::hasColumn('format7_form4s', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
            });
        }

        // Foreign keys for rekap table - format references
        if (Schema::hasTable('rekap')) {
            Schema::table('rekap', function (Blueprint $table) {
                if (Schema::hasColumn('rekap', 'bencana_id')) {
                    $table->foreign('bencana_id')->references('id')->on('bencana')->onDelete('cascade');
                }
                if (Schema::hasColumn('rekap', 'format1_form4_id')) {
                    $table->foreign('format1_form4_id')->references('id')->on('format1_form4s')->onDelete('set null');
                }
                if (Schema::hasColumn('rekap', 'format5_form4_id')) {
                    $table->foreign('format5_form4_id')->references('id')->on('format5_form4s')->onDelete('set null');
                }
                if (Schema::hasColumn('rekap', 'format6_form4_id')) {
                    $table->foreign('format6_form4_id')->references('id')->on('format6_form4s')->onDelete('set null');
                }
                if (Schema::hasColumn('rekap', 'format7_form4_id')) {
                    $table->foreign('format7_form4_id')->references('id')->on('format7_form4s')->onDelete('set null');
                }
            });
        }

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop all foreign keys in reverse order
        $tables = [
            'role_has_permissions' => ['permission_id', 'role_id'],
            'model_has_roles' => ['role_id'],
            'model_has_permissions' => ['permission_id'],
            'rekap' => ['bencana_id', 'format1_form4_id', 'format5_form4_id', 'format6_form4_id', 'format7_form4_id'],
            'format7_form4s' => ['bencana_id'],
            'format6_form4s' => ['bencana_id'],
            'format5_form4s' => ['bencana_id'],
            'format1_form4s' => ['bencana_id'],
            'form_data' => ['bencana_id'],
            'anggaran' => ['bencana_id'],
            'analisa' => ['bencana_id'],
            'form9' => ['bencana_id'],
            'fgd' => ['bencana_id'],
            'rumahtangga' => ['bencana_id'],
            'pendataan' => ['bencana_id'],
            'keputusan' => ['bencana_id'],
            'form1' => ['bencana_id'],
            'environmental_reports' => ['bencana_id'],
            'transportation_reports' => ['bencana_id'],
            'government_reports' => ['bencana_id'],
            'health_reports' => ['bencana_id'],
            'education_reports' => ['bencana_id'],
            'wilayah_bencana' => ['bencana_id'],
            'kerugian' => ['bencana_id'],
            'form_perumahan' => ['bencana_id'],
            'detail_kerusakan' => ['bencana_id', 'kategori_kerusakan_id'],
            'kategori_kerusakan' => ['bencana_id'],
            'rekapitulasi' => ['bencana_id', 'created_by', 'updated_by'],
        ];

        foreach ($tables as $tableName => $foreignKeys) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($foreignKeys) {
                    foreach ($foreignKeys as $foreignKey) {
                        try {
                            $table->dropForeign([$foreignKey]);
                        } catch (Exception $e) {
                            // Ignore if foreign key doesn't exist
                        }
                    }
                });
            }
        }
    }
};
