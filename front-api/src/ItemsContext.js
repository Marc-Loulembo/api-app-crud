import React, { createContext, useState, useEffect } from 'react';

export const ItemsContext = createContext();
const API_URL = 'http://localhost/api/';

export const ItemsProvider = ({ children }) => {
    const [items, setItems] = useState([]);

    const fetchItems = async () => {
    try {
        const res = await fetch(`${API_URL}/items`);
        const data = await res.json();
        setItems(data);
    } catch (error) {
        console.error("Erreur lors de la récupération des items :", error);
    }
};

const createItem = async (item) => {
    try {
        const res = await fetch(`${API_URL}/items`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(item)
        });
        if (res.ok) {
        fetchItems();
        }
    } catch (error) {
        console.error("Erreur lors de la création d'un item :", error);
    }
};

const updateItem = async (id, item) => {
    try {
        const res = await fetch(`${API_URL}/items/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(item)
        });
        if (res.ok) {
        fetchItems();
        }
    } catch (error) {
        console.error("Erreur lors de la mise à jour d'un item :", error);
    }
};

const deleteItem = async (id) => {
    try {
        const res = await fetch(`${API_URL}/items/${id}`, {
        method: 'DELETE'
        });
        if (res.ok) {
        fetchItems();
        }
    } catch (error) {
        console.error("Erreur lors de la suppression d'un item :", error);
    }
};

useEffect(() => {
    fetchItems();
}, []);

return (
    <ItemsContext.Provider value={{ items, createItem, updateItem, deleteItem }}>
        {children}
    </ItemsContext.Provider>
);
};
