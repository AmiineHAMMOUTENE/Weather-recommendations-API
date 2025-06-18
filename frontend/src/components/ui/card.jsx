// src/components/ui/card.jsx
import * as React from "react";

export function Card({ children, className = "" }) {
  return (
    <div
      className={
        "rounded-lg border border-gray-200 bg-white p-4 shadow-sm " + className
      }
    >
      {children}
    </div>
  );
}
