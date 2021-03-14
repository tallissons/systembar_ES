<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\CategoriaProduto;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoriaProduto::create([
            'nome' => 'Comidas'
        ]);

        CategoriaProduto::create([
            'nome' => 'Bebidas'
        ]);

        Produto::create([
            'nome' => 'Cerveja Skol Litrão',
            'preco' => 7,
            'categoria_id' => 2
        ]);

        Produto::create([
            'nome' => 'Cerveja Brahma Litrão',
            'preco' => 7,
            'categoria_id' => 2
        ]);

        Produto::create([
            'nome' => 'Cerveja Subzero Litrão',
            'preco' => 6.50,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Cerveja Skol 600ml',
            'preco' => 6,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Cerveja Brahma 600ml',
            'preco' => 6,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Cerveja SUBZERO 600ml',
            'preco' => 5.50,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Guaraná 2 litros',
            'preco' => 7.50,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Coca-Cola 2 litros',
            'preco' => 9,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Sukita laranja 2 litros',
            'preco' => 6,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Sukita uva 2 litros',
            'preco' => 6,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Coca-Cola 300ml',
            'preco' => 3.50,
            'categoria_id' => 2
        ]);
        
        Produto::create([
            'nome' => 'Água mineral 270ml',
            'preco' => 2,
            'categoria_id' => 2
        ]);

        Produto::create([
            'categoria_id' => 1,
            'nome' => 'Porção grande de carne',
            'preco' => 30,
            'descricao' => 'Porção grande de carne com batata frita e mandioca.'
        ]);

        Produto::create([
            'categoria_id' => 1,
            'nome' => 'Porção média de carne',
            'preco' => 25,
            'descricao' => 'Porção média de carne com batata frita e mandioca.'
        ]);

        Produto::create([
            'categoria_id' => 1,
            'nome' => 'Porção pequena de carne',
            'preco' => 20,
            'descricao' => 'Porção pequena de carne com batata frita e mandioca.'
        ]);

        Produto::create([
            'categoria_id' => 1,
            'nome' => 'Caldo',
            'preco' => 4
        ]);

        Produto::create([
            'categoria_id' => 1,
            'nome' => 'Bisteca',
            'preco' => 4
        ]);

        Produto::create([
            'categoria_id' => 1,
            'nome' => 'Coxa com sobrecoxa de frango',
            'preco' => 6.5
        ]);
    }
}
