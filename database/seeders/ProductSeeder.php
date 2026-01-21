<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductConfiguration;
use App\Models\ProductConfigurationSpec;
use App\Models\ProductImage;
use App\Models\ProductSpec;
use App\Models\ProductDocument;
use App\Models\ProductRelated;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Продукт 1: VIST Workstation X1000
        $workstation = Product::create([
            'sku' => 'WSX1000',
            'name' => 'VIST Workstation X1000',
            'subtitle' => 'CAD/BIM, рендеринг, інженерні симуляції',
            'description' => 'Професійна робоча станція для Autodesk, SolidWorks, Blender, Houdini та обчислень.',
            'product_type' => 'workstation',
            'status' => 'in_stock',
            'warranty_months' => 36,
            'price' => 120000.00,
        ]);

        // Зображення для Workstation
        ProductImage::create([
            'product_id' => $workstation->id,
            'image_url' => 'img/x1000/rs1.jpg',
            'is_primary' => true,
            'sort_order' => 1,
        ]);
        ProductImage::create([
            'product_id' => $workstation->id,
            'image_url' => 'img/x1000/rs2.jpg',
            'is_primary' => false,
            'sort_order' => 2,
        ]);
        ProductImage::create([
            'product_id' => $workstation->id,
            'image_url' => 'img/x1000/rs3.jpg',
            'is_primary' => false,
            'sort_order' => 3,
        ]);

        // Специфікації для Workstation
        $workstationSpecs = [
            ['spec_key' => 'CPU', 'spec_value' => 'Intel Xeon W-2245 (8C/16T, Turbo 4.7 GHz)', 'sort_order' => 1],
            ['spec_key' => 'GPU', 'spec_value' => 'NVIDIA RTX A2000 12GB', 'sort_order' => 2],
            ['spec_key' => 'RAM', 'spec_value' => '64 GB DDR5 ECC', 'sort_order' => 3],
            ['spec_key' => 'Storage', 'spec_value' => '2TB NVMe Gen4 SSD', 'sort_order' => 4],
            ['spec_key' => 'Power', 'spec_value' => '750W 80+ Gold', 'sort_order' => 5],
            ['spec_key' => 'Use Case', 'spec_value' => 'CAD, BIM, Rendering, Simulation', 'sort_order' => 6],
        ];

        foreach ($workstationSpecs as $spec) {
            ProductSpec::create(array_merge(['product_id' => $workstation->id], $spec));
        }

        // Конфігурації для Workstation
        $config1 = ProductConfiguration::create([
            'product_id' => $workstation->id,
            'config_name' => 'Base',
            'price' => 120000.00,
            'description' => 'Xeon W, 32 GB ECC, RTX A2000',
        ]);

        ProductConfigurationSpec::create([
            'configuration_id' => $config1->id,
            'spec_key' => 'CPU',
            'spec_value' => 'Xeon W-2245',
            'sort_order' => 1,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $config1->id,
            'spec_key' => 'RAM',
            'spec_value' => '32 GB ECC',
            'sort_order' => 2,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $config1->id,
            'spec_key' => 'GPU',
            'spec_value' => 'RTX A2000',
            'sort_order' => 3,
        ]);

        $config2 = ProductConfiguration::create([
            'product_id' => $workstation->id,
            'config_name' => 'CAD PRO',
            'price' => 145000.00,
            'description' => 'Xeon W, 64 GB ECC, RTX A2000',
        ]);

        ProductConfigurationSpec::create([
            'configuration_id' => $config2->id,
            'spec_key' => 'CPU',
            'spec_value' => 'Xeon W-2245',
            'sort_order' => 1,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $config2->id,
            'spec_key' => 'RAM',
            'spec_value' => '64 GB ECC',
            'sort_order' => 2,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $config2->id,
            'spec_key' => 'GPU',
            'spec_value' => 'RTX A2000',
            'sort_order' => 3,
        ]);

        $config3 = ProductConfiguration::create([
            'product_id' => $workstation->id,
            'config_name' => 'Render/AI Boost',
            'price' => 185000.00,
            'description' => 'Xeon W, 128 GB ECC, RTX 4000 Ada',
        ]);

        ProductConfigurationSpec::create([
            'configuration_id' => $config3->id,
            'spec_key' => 'CPU',
            'spec_value' => 'Xeon W-2245',
            'sort_order' => 1,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $config3->id,
            'spec_key' => 'RAM',
            'spec_value' => '128 GB ECC',
            'sort_order' => 2,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $config3->id,
            'spec_key' => 'GPU',
            'spec_value' => 'RTX 4000 Ada',
            'sort_order' => 3,
        ]);

        // Документи для Workstation
        ProductDocument::create([
            'product_id' => $workstation->id,
            'doc_title' => 'Datasheet X1000',
            'doc_url' => 'docs/x1000-datasheet.pdf',
            'doc_type' => 'pdf',
            'sort_order' => 1,
        ]);
        ProductDocument::create([
            'product_id' => $workstation->id,
            'doc_title' => 'Manual X1000',
            'doc_url' => 'docs/x1000-manual.pdf',
            'doc_type' => 'manual',
            'sort_order' => 2,
        ]);

        // Продукт 2: VIST Industrial PC IPC-510
        $ipc = Product::create([
            'sku' => 'IPC510',
            'name' => 'VIST Industrial PC IPC-510',
            'subtitle' => 'SCADA, MES, телеметрія, робота 24/7',
            'description' => 'Fanless індустріальний ПК з широким температурним діапазоном, COM-портами та DIN-монтажем.',
            'product_type' => 'ipc',
            'status' => 'by_order',
            'warranty_months' => 36,
            'price' => null,
        ]);

        // Зображення для IPC
        ProductImage::create([
            'product_id' => $ipc->id,
            'image_url' => 'img/ipc510/industrial_pc_1.png',
            'is_primary' => true,
            'sort_order' => 1,
        ]);
        ProductImage::create([
            'product_id' => $ipc->id,
            'image_url' => 'img/ipc510/industrial_pc_2.png',
            'is_primary' => false,
            'sort_order' => 2,
        ]);
        ProductImage::create([
            'product_id' => $ipc->id,
            'image_url' => 'img/ipc510/industrial_pc_3.png',
            'is_primary' => false,
            'sort_order' => 3,
        ]);

        // Специфікації для IPC
        $ipcSpecs = [
            ['spec_key' => 'CPU', 'spec_value' => 'Intel Atom/Celeron Industrial', 'sort_order' => 1],
            ['spec_key' => 'RAM', 'spec_value' => '8–32 GB DDR4 SO-DIMM', 'sort_order' => 2],
            ['spec_key' => 'Storage', 'spec_value' => 'NVMe + SATA SSD', 'sort_order' => 3],
            ['spec_key' => 'I/O', 'spec_value' => '2× LAN, 2× COM, 4× USB, HDMI/VGA', 'sort_order' => 4],
            ['spec_key' => 'Temperature', 'spec_value' => '-20…+60 °C', 'sort_order' => 5],
            ['spec_key' => 'Cooling', 'spec_value' => 'Fanless (пасивне)', 'sort_order' => 6],
            ['spec_key' => 'Power Input', 'spec_value' => '9–36 V DC', 'sort_order' => 7],
        ];

        foreach ($ipcSpecs as $spec) {
            ProductSpec::create(array_merge(['product_id' => $ipc->id], $spec));
        }

        // Конфігурації для IPC
        $ipcConfig1 = ProductConfiguration::create([
            'product_id' => $ipc->id,
            'config_name' => 'Basic',
            'price' => null,
            'description' => 'Celeron, 8 GB RAM, 128 GB SSD',
        ]);

        ProductConfigurationSpec::create([
            'configuration_id' => $ipcConfig1->id,
            'spec_key' => 'CPU',
            'spec_value' => 'Celeron Industrial',
            'sort_order' => 1,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $ipcConfig1->id,
            'spec_key' => 'RAM',
            'spec_value' => '8 GB DDR4',
            'sort_order' => 2,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $ipcConfig1->id,
            'spec_key' => 'Storage',
            'spec_value' => '128 GB SSD',
            'sort_order' => 3,
        ]);

        $ipcConfig2 = ProductConfiguration::create([
            'product_id' => $ipc->id,
            'config_name' => 'SCADA Extended',
            'price' => null,
            'description' => 'Atom, 16 GB RAM, 256 GB SSD, 2× COM',
        ]);

        ProductConfigurationSpec::create([
            'configuration_id' => $ipcConfig2->id,
            'spec_key' => 'CPU',
            'spec_value' => 'Atom Industrial',
            'sort_order' => 1,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $ipcConfig2->id,
            'spec_key' => 'RAM',
            'spec_value' => '16 GB DDR4',
            'sort_order' => 2,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $ipcConfig2->id,
            'spec_key' => 'Ports',
            'spec_value' => '2× COM, 2× LAN',
            'sort_order' => 3,
        ]);

        // Документи для IPC
        ProductDocument::create([
            'product_id' => $ipc->id,
            'doc_title' => 'Datasheet IPC-510',
            'doc_url' => 'docs/ipc510-datasheet.pdf',
            'doc_type' => 'pdf',
            'sort_order' => 1,
        ]);
        ProductDocument::create([
            'product_id' => $ipc->id,
            'doc_title' => 'Mechanical Drawing IPC-510',
            'doc_url' => 'docs/ipc510-mechanical.pdf',
            'doc_type' => 'other',
            'sort_order' => 2,
        ]);

        // Продукт 3: VIST Server RS-2400
        $server = Product::create([
            'sku' => 'RS2400',
            'name' => 'VIST Server RS-2400',
            'subtitle' => 'Віртуалізація, бази даних, хмарні сервіси',
            'description' => 'Сервер класу enterprise з підтримкою RAID, ECC-пам\'яті, dual PSU та 10GbE.',
            'product_type' => 'server',
            'status' => 'in_stock',
            'warranty_months' => 36,
            'price' => 180000.00,
        ]);

        // Зображення для Server
        ProductImage::create([
            'product_id' => $server->id,
            'image_url' => 'img/server/server1.png',
            'is_primary' => true,
            'sort_order' => 1,
        ]);
        ProductImage::create([
            'product_id' => $server->id,
            'image_url' => 'img/server/server2.png',
            'is_primary' => false,
            'sort_order' => 2,
        ]);
        ProductImage::create([
            'product_id' => $server->id,
            'image_url' => 'img/server/server3.png',
            'is_primary' => false,
            'sort_order' => 3,
        ]);

        // Специфікації для Server
        $serverSpecs = [
            ['spec_key' => 'CPU', 'spec_value' => 'Dual Intel Xeon Silver/Gold', 'sort_order' => 1],
            ['spec_key' => 'RAM', 'spec_value' => 'ECC DDR4, до 1024 GB', 'sort_order' => 2],
            ['spec_key' => 'Storage', 'spec_value' => '4–8× SSD/HDD, RAID 0/1/5/10', 'sort_order' => 3],
            ['spec_key' => 'Network', 'spec_value' => '2× 10GbE', 'sort_order' => 4],
            ['spec_key' => 'Power', 'spec_value' => 'Dual PSU (резервування)', 'sort_order' => 5],
            ['spec_key' => 'Form Factor', 'spec_value' => '2U Rackmount', 'sort_order' => 6],
        ];

        foreach ($serverSpecs as $spec) {
            ProductSpec::create(array_merge(['product_id' => $server->id], $spec));
        }

        // Конфігурації для Server
        $serverConfig1 = ProductConfiguration::create([
            'product_id' => $server->id,
            'config_name' => 'Virtualization Node',
            'price' => 180000.00,
            'description' => '2× Xeon Silver, 64 GB ECC, RAID1',
        ]);

        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig1->id,
            'spec_key' => 'CPU',
            'spec_value' => '2× Xeon Silver',
            'sort_order' => 1,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig1->id,
            'spec_key' => 'RAM',
            'spec_value' => '64 GB ECC',
            'sort_order' => 2,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig1->id,
            'spec_key' => 'Storage',
            'spec_value' => 'RAID1 SSD',
            'sort_order' => 3,
        ]);

        $serverConfig2 = ProductConfiguration::create([
            'product_id' => $server->id,
            'config_name' => 'Database Server',
            'price' => 240000.00,
            'description' => 'Xeon Gold, 128 GB ECC, NVMe RAID5',
        ]);

        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig2->id,
            'spec_key' => 'CPU',
            'spec_value' => 'Xeon Gold',
            'sort_order' => 1,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig2->id,
            'spec_key' => 'RAM',
            'spec_value' => '128 GB ECC',
            'sort_order' => 2,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig2->id,
            'spec_key' => 'Storage',
            'spec_value' => 'NVMe RAID5',
            'sort_order' => 3,
        ]);

        $serverConfig3 = ProductConfiguration::create([
            'product_id' => $server->id,
            'config_name' => 'Render / HPC Node',
            'price' => 320000.00,
            'description' => 'Xeon Gold, 256 GB ECC, 4× NVMe',
        ]);

        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig3->id,
            'spec_key' => 'CPU',
            'spec_value' => 'Xeon Gold',
            'sort_order' => 1,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig3->id,
            'spec_key' => 'RAM',
            'spec_value' => '256 GB ECC',
            'sort_order' => 2,
        ]);
        ProductConfigurationSpec::create([
            'configuration_id' => $serverConfig3->id,
            'spec_key' => 'Storage',
            'spec_value' => '4× NVMe SSD',
            'sort_order' => 3,
        ]);

        // Документи для Server
        ProductDocument::create([
            'product_id' => $server->id,
            'doc_title' => 'Datasheet RS-2400',
            'doc_url' => 'docs/rs2400-datasheet.pdf',
            'doc_type' => 'pdf',
            'sort_order' => 1,
        ]);
        ProductDocument::create([
            'product_id' => $server->id,
            'doc_title' => 'CE Certificate RS-2400',
            'doc_url' => 'docs/rs2400-cert.pdf',
            'doc_type' => 'certificate',
            'sort_order' => 2,
        ]);

        // Пов'язані продукти
        ProductRelated::create([
            'product_id' => $workstation->id,
            'related_id' => $ipc->id,
            'relation_type' => 'recommended',
        ]);
        ProductRelated::create([
            'product_id' => $ipc->id,
            'related_id' => $server->id,
            'relation_type' => 'recommended',
        ]);
        ProductRelated::create([
            'product_id' => $server->id,
            'related_id' => $workstation->id,
            'relation_type' => 'alternative',
        ]);
    }
}
